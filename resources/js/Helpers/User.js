import Token from "./Token";
import AppStorage from "./AppStorage";

class User {
    async responseAfterLogin(response, nextUrl = '/') {
        const access_token = response.data.access_token;
        if (access_token) {
            AppStorage.store(access_token);
        }
        await this.getUserData(access_token).then(res => {
            window.location = nextUrl
        });

    }

    async getUserData(access_token) {
        try {
            const config = {
                headers: {Authorization: `Bearer ${access_token}`}
            };
            let res = await axios.get(`${APP_URL}/api/user`, config)
                .then(response => {
                    if (response.data.rui) {
                        AppStorage.storeUser(response.data.rui, response.data.run, response.data.url);
                    }
                })
            return res;
        } catch (err) {
            console.error(err);
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
        return this.hasToken();
    }

    name() {
        if (this.loggedIn())
            return AppStorage.getUserName();
        return false;
    }


    role() {
        if (this.loggedIn())
            return AppStorage.getUserRole();
        return false;
    }

    isAdmin() {
        if (this.role() === 'admin') {
            return true;
        } else {
            return false;
        }
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
