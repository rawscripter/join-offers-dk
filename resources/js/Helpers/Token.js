import AppStorage from './AppStorage'

class Token {
    isValid(token) {
        axios.get('http://laravu.test/api/user')
            .then(response => {
                if (response.data.rui) {
                    AppStorage.storeUser(response.data.rui, response.data.run);
                }
                return true;
            })
            .catch(error => {
                return true;
            });
        if (AppStorage.getUserId())
            return true;
    }

}

export default Token = new Token();
