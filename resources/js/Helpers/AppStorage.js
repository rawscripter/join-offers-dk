class AppStorage {
    storeToken(token) {
        localStorage.setItem('token', token);
    }

    store(token) {
        this.storeToken(token)
    }

    clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('userId');
        localStorage.removeItem('user');
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
        localStorage.setItem('id', Id);
    }


    getUserId() {
       return  localStorage.getItem('id');
    }

    storeUserName(user) {
        localStorage.setItem('user', user);
    }


    getUserName() {
        return localStorage.getItem('user');
    }

}

export default AppStorage = new AppStorage();
