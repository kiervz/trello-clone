import AppStorage from "./AppStorage";

class User {

    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const user = res.data.user;
        AppStorage.store(access_token, user);
    }

    hasToken() {
        const storedToken = AppStorage.getToken();

        if (storedToken) {
            return storedToken ? true : this.logOut();
        }

        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logOut() {
        AppStorage.clear();
        window.location = '/login';
    }

    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }

}

export default User = new User();
