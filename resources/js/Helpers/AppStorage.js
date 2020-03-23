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
    }

    getToken() {
        return localStorage.getItem('token')
    }


    //storing user info

    storeUser(id, user) {
        this.storeUserId(id);
        this.storeUserName(user)
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


    getUserName() {
        return atob(localStorage.getItem('run'));
    }

}

export default AppStorage = new AppStorage();
