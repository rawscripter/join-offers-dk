import VueSweetalert2 from 'vue-sweetalert2';

class Notification {
    showSuccessAlert(message) {
        Vue.swal({
            icon: 'success',
            title: 'Congratulations.',
            text: message,
            type: 'success',
            timer: 3000
        });
    }

    showWarningAlert(message) {
        Vue.swal({
            icon: 'warning',
            title: 'Wait!.',
            text: message,
            type: 'warning',
            timer: 3000
        });
    }

    showErrorAlert(message) {
        Vue.swal({
            icon: 'error',
            title: 'Failed.',
            text: message,
            type: 'error',
            timer: 3000
        });
    }
}

export default Notification = new Notification();
