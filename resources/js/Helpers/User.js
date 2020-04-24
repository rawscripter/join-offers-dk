import Token from "./Token";
import AppStorage from "./AppStorage";


class User {

    responseAfterLogin(response) {

        const access_token = response.data.access_token;

        if (access_token) {
            AppStorage.store(access_token);
        }
        window.location = '/'
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken);
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    name() {
        if (this.loggedIn())
            return AppStorage.getUserName();
        return false;
    }

    id() {
        if (this.loggedIn())
            return AppStorage.getUserId();
        return false;
    }

    logOut() {
        axios.post(`${APP_URL}/api/logout`)
            .then(response => {
                AppStorage.clear();
                window.location = '/login';
            })
            .catch(error => {
                console.error(error);
            })
    }

    own(id) {
        return this.id() === id;
    }
}

export default User = new User();
