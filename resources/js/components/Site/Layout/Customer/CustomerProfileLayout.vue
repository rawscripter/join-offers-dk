<template>
    <div class="main-content">
        <div class="user-profile-update-form ">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="main-profile-update shadow p-4">
                        <h5>Update your profile information</h5>
                        <hr>
                        <form action="#">
                            <div class="form-group">
                                <label for="f_name">First name</label>
                                <input type="text" class="form-control" name="f_name"
                                       placeholder="First name">
                            </div>
                            <div class="form-group">
                                <label for="l_name">last name</label>
                                <input type="text" class="form-control" name="l_name"
                                       placeholder="First name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number</label>
                                <input type="text" class="form-control" name="phone"
                                       placeholder="phone number">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email"
                                       placeholder="Emal">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-success rounded-0" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="password-update-form shadow p-4">
                        <h5>Update your Password</h5>
                        <form action="#">
                            <div class="form-group">
                                <label for="password">Currentpassword</label>
                                <input type="text" class="form-control" name="password"
                                       placeholder="Current password">
                            </div>
                            <div class="form-group">
                                <label for="new_password">New password</label>
                                <input type="text" class="form-control" name="new_password"
                                       placeholder="New password">
                            </div>
                            <div class="form-group">
                                <label for="conform_password">New password</label>
                                <input type="text" class="form-control" name="conform_password"
                                       placeholder="Conform password">
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" class="btn btn-success rounded-0"
                                       value="Change password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CustomerProfileLayout"
    }
</script>

<style scoped>

</style>
