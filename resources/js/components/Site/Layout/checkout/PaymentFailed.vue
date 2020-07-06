<template>
    <div class="text-center m-100 mt-5">
        <div class="mt-6 big-error-font">
            <span> <strong>Betaling mislykkedes.</strong></span>
            <br>
        </div>
        <div class="mt-2">
            <p class="text-mute"><strong>
                Prøv igen.
                <br>
                <br>
            </strong></p>

            <p class="text-black" @click="$router.go(-2)"><strong>
                Gå tilbage til Check out.
            </strong></p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PaymentFailed"
    }
</script>

<style scoped>

    .big-error-font {
        font-size: 48px;
        color: #3939396b;
        margin-top: 150px !important;
    }

    .text-mute {
        color: #3939396b;
    }

    .text-black {
        color: #da4e21;
        cursor: pointer;
    }
</style>
