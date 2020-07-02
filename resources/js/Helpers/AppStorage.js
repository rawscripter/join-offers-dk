class AppStorage {
    storeToken(token) {
        localStorage.setItem('token', token);
    }

    store(token) {
        this.storeToken(token)
    }

    clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('rui');
        localStorage.removeItem('run');
        localStorage.removeItem('url');
    }

    getToken() {
        return localStorage.getItem('token')
    }


    //storing user info

    storeUser(id, user, role) {
        this.storeUserId(id);
        this.storeUserName(user)
        this.storeUserRole(role)
    }

    storeUserId(Id) {
        localStorage.setItem('rui', Id);
    }


    getUserId() {
        return atob(localStorage.getItem('rui'));
    }

    storeUserName(user) {
        localStorage.setItem('run', user);
    }

    storeUserRole(role) {
        localStorage.setItem('url', role);
    }

    getUserName() {
        return atob(localStorage.getItem('run'));
    }

    getUserRole() {
        return atob(localStorage.getItem('url'));
    }


}

export default AppStorage = new AppStorage();
