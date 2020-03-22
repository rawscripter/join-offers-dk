import Token from "./Token";
import AppStorage from "./AppStorage";


class User {
    login(formData) {
        axios.post('http://laravu.test/api/login', formData)
            .then(response => {
                this.responseAfterLogin(response);
                this.hasToken();
                window.location = '/'
            })
            .catch(error => {
                console.error(error);
            })


    }

    responseAfterLogin(response) {
        const access_token = response.data.access_token;

        if (access_token) {
            AppStorage.store(access_token);
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken);
        }
        return false;
    }

    loggedIn() {

        if (this.hasToken()) {
            return true;
        }
        return false;
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
        AppStorage.clear();
    }

    own(id) {
        return this.id() === id;
    }
}

export default User = new User();
