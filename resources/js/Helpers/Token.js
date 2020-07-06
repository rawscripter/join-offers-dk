import AppStorage from './AppStorage'
import User from "./User";

class Token {
    isValid(token) {
        return !!AppStorage.getUserId();
    }

}

export default Token = new Token();
