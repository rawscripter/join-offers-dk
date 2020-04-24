import AppStorage from './AppStorage'
import User from "./User";

class Token {
    isValid(token) {
        axios.get(`${APP_URL}/api/user`)
            .then(response => {
                if (response.data.rui) {
                    AppStorage.storeUser(response.data.rui, response.data.run);
                } else {
                    User.logOut();
                }
            })
            .catch(error => {
                return true;
            });
        if (AppStorage.getUserId())
            return true;
    }

}

export default Token = new Token();
