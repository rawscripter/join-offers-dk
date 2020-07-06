<template>
    <footer class="container-fluid w3-padding-32 w3-left text-white footer-section">
        <div class="row footer-row-contianer">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6 FooterSectionGap">
                        <h4>DanPanel ApS</h4>
                        <p>Farverland 6,<br> 2600 Glostrup,</br> Danmark </p>
                        <p class="footer-line-gap">CVR-Nummer: 38362925</p>

                    </div>
                    <div class="col-md-6 FooterSectionGap">
                        <h4>Kontakt</h4>
                        <p class="" style="">Tlf.: +45 32 22 32 03</p>
                        <p class="footer-line-gap">Mail: hej@danpanel.dk</p><br>
                        <p class="footer-line-gap">Man-Fre fra kl. 09:00 - 15:00 </p>
                        <p class="">Vi svarer inden for 24 timer <br> alle arbejdsdage  </p>
                    </div>
                </div>

            </div>

            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6 FooterSectionGap">
                        <h4>DanPanel Group</h4>
                        <p class="" style=""><a class="text-white h6 footer-hover" href="https://danpanel.dk/products/Hent%20Tilbud">Hent tilbud</a></p>
                        <!--<p class="footer-line-gap"><a class="text-white h6 footer-hover" href="https://danpanel.dk/products/Privat">Privat</a></p>-->
                        <p class="footer-line-gap"><a class="text-white h6 footer-hover" href="https://offentlige.danpanel.dk/" target="_blank">Offentlige</a></p>
                        <p class="footer-line-gap"><a class="text-white h6 footer-hover" href="https://webshop.danpanel.dk/" target="_blank">Webshop</a></p>
                    </div>
                    <div class="col-md-6 FooterSectionGap">
                        <h4><a class="text-white footer-hover h4" href="https://danpanel.dk/om" target="_blank">Om os</a></h4>
                        <p class="">Bliv partner</p>
                        <p class="footer-line-gap">Bliv ambassadør</p> </br>
                        <p class="footer-line-gap"><a class="text-white h6 footer-hover" href="/assets/site/assets/OtherFiles/Handelsbetingelser-og-vilkar-Samlet.pdf" target="_blank">Handelsbetingelser </a></p>
                        <p class="footer-line-gap"><a class="text-white h6 footer-hover" href="/assets/site/assets/OtherFiles/Cookie-og-privatlivspolitik-DanPanel.pdf" target="_blank">Privatlivspolitik & Cookies</a></p>
                        <p class="footer-line-gap"><a class="text-white h6 footer-hover" href="https://certifikat.emaerket.dk/danpanel.dk?fbclid=IwAR2VDaxwELCwtxtC_xBNCEEf-V1JRRzknI1VgWITjoM3vFm7Cf1MZI_Xrh0"  target = "_blank">E-mærket certifikat</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-2 FooterSectionGap">
                <p><img src="/frontend/assets/img/site.png"  height="90" alt="Logo">   </p>
                <p><a class="footer-hover" href="https://certifikat.emaerket.dk/danpanel.dk?fbclid=IwAR2VDaxwELCwtxtC_xBNCEEf-V1JRRzknI1VgWITjoM3vFm7Cf1MZI_Xrh0"  target = "_blank">
                    <img src="/images/icons/e-market03.png" width="150px" alt="e-mærket"> </a></p>
                <p> <img src="/images/icons/Sitemap-footer-betalingsmuligheder.png" width="220px" height="40px;" alt="betalingsmuligheder"></p>
            </div>
        </div>
        <div class="row footer-row-contianer" style="">
            <div class="col-md-4">
                <a href="#" class="w3-button w3-blue w3-round w3-center footer-arrow-up"><i class="w3-round fa fa-arrow-up"></i></a>
            </div>
            <div class="col-md-4 footer-align-items-center">
                <a class="m-2" href="https://www.facebook.com/DanPanelDK" target="_blank">
                    <i class="fab fa-facebook-square fa-3x w3-hover-opacity" style=""></i>
                </a>
                <a class="m-2" href="https://www.linkedin.com/company/danpanel/" target="_blank"> <i class="fab fa-linkedin fa-3x w3-hover-opacity" style="color:whit"></i></a>
                <a class="m-2" href="https://www.instagram.com/danpanel.dk/" target="_blank"> <i class="fab fa-instagram fa-3x w3-hover-opacity" style="color:whit"></i></a>
            </div>
            <div class="col-md-4 footer-arrow-up-mobile" style="text-align:center; justify-content:center;">
                <a href="#" class="w3-button w3-blue w3-round w3-center"><i class="w3-round fa fa-arrow-up"></i></a>
            </div>
        </div>
        <div class="row footer-align-items-center">
            <div class="col-md-12 copyright-text1">
                <p style="text-align:center">Copyright &copy; 2020 DanPanel Aps. All Right Reserved.</p>
            </div>

        </div>
    </footer>
</template>

<script>
    export default {
        name: "SiteFooter",
    }
</script>

<style scoped>
    .footer-section {
        position: relative !important;
        margin-top: 50px;
    }

</style>
