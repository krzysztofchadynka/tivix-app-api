var apiClient = (function () {
    function login(email, password) {
        let apiResponse = null;

        $.ajax({
            url: "/api/user/login",
            type: 'post',
            async: false,
            data: {
                email: email,
                password: password
            },
            success: (response) => {
                apiResponse = 'success';
                sessionStorage.setItem('userToken', response.data.token);
            },
            error: (errors) => {
                if (errors.status === 422) {
                    apiResponse = '';
                    let response = errors.responseJSON.errors;
                    let errorsCount = Object.keys(response).length;
                    if (errorsCount > 0) {
                        $.each(response, (field, error) => {
                            apiResponse += error + ' ';
                        });
                    }
                } else {
                    apiResponse = errors.responseJSON.message;
                }
            }
        });

        return apiResponse;
    }

    function logout() {
        return $.ajax({
            url: "/api/user/logout",
            headers: {Authorization: 'Bearer ' + sessionStorage.getItem('userToken')},
            type: 'post',
            async: false,
            success: () => {
                sessionStorage.setItem('userToken', null);
            },
        });
    }

    function getPositionsListFromApi(type, title) {
        let apiResponse = '<p>No results found.</p>';

        $.ajax({
            url: '/api/omdb/' + type + '/' + title,
            type: 'get',
            async: false,
            headers: {Authorization: 'Bearer ' + sessionStorage.getItem('userToken')},
            success: (response) => {
                if (Object.keys(response.data).length > 0) {
                    apiResponse = '<ul class="list-group">';
                    $.each(response.data, (key, info) => {
                        apiResponse += '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        apiResponse += '<a href="' + info.id + '">';
                        apiResponse += '<h4>' + info.title + ', ' + info.year + '</h4>';
                        apiResponse += '<div class="image-parent">';
                        apiResponse += '<img class="img-fluid" src="' + info.imageUrl + '" />';
                        apiResponse += '</div>';
                        apiResponse += '</a>';
                        apiResponse += '</li>';
                    });
                    apiResponse += '</ul>';
                }
            },
            error: () => {
                apiResponse = '<p>No results found.</p>';
            }
        });

        return apiResponse;
    }

    return {
        login: login,
        logout: logout,
        getPositionsListFromApi: getPositionsListFromApi
    }
})();

$(document).ready(function() {
    let userToken = sessionStorage.getItem('userToken');

    if (userToken === null || userToken === 'null') {
        $('#loggedUserForm').hide();
        $('#loginForm').show();
    } else {
        $('#loginForm').hide();
        $('#loggedUserForm').show();
    }

    $('#loginButton').click(() => {
        let response = apiClient.login(
            $('#loginEmail').val(),
            $('#loginPassword').val()
        );

        if (response !== 'success') {
            console.log(response);
            $('#loginResult').text(response);
        } else {
            window.location.reload();
        }
    });

    $('#logoutButton').click(() => {
        apiClient.logout().then(() => {
            window.location.reload();
        });
    });

    $('#getMoviesButton').click(() => {
        let response = apiClient.getPositionsListFromApi(
            'movies',
            $('#positionTitle').val(),
            $('#positionYear').val()
        );

        $('#apiResponse').html(response);
    });

    $('#getEpisodesButton').click(() => {
        let response = apiClient.getPositionsListFromApi(
            'episodes',
            $('#positionTitle').val(),
            $('#positionYear').val()
        );

        $('#apiResponse').html(response);
    });

    $('#getSeriesButton').click(() => {
        let response = apiClient.getPositionsListFromApi(
            'series',
            $('#positionTitle').val(),
            $('#positionYear').val()
        );

        $('#apiResponse').html(response);
    });
});
