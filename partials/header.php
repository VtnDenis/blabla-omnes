
<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
include ("../connexion_bdd.php");
?>
<header>
    <div class='div-header'>
        <div class='sm:hidden'>
            <img class='image-menu-icon' src='../img/menu.png' alt='Menu icon' id='menuIcon' onclick='openMenu();'>
            <div id='sideMenu' class='side-menu'>
                <div class='pl-2 pb-5'>
                    <img class='image-menu-icon' src='../img/menu.png' alt='Menu icon' id='menuIcon'
                         onclick='closeMenu()'>
                </div>
                <div class='div-onglet-menu-ouvrant'>
                    <a class='font-manrope mt-0.5 font-bold text-sm hover:underline' href='../recherche_trajet/recherche.php'>CHERCHER UN
                        TRAJET</a> <!--Différencier les liens si connecté ou non--->
                </div>
                <div class='div-onglet-menu-ouvrant'>

                    <a class='font-manrope mt-0.5 font-bold text-sm hover:underline' href='../publier_trajet/traitementPermisValide.php'>PUBLIER UN
                        TRAJET</a> <!--Différencier les liens si connecté ou non--->
                </div>
                <div class='div-onglet-menu-ouvrant'>

                    <a class='font-manrope mt-0.5 font-bold text-sm hover:underline' href='../mes_trajets/mes_trajets.php'>MES
                        TRAJETS</a> <!--Mettre bon lien mes trajets--->
                </div>
            </div>
        </div>
        <div class='sm:hidden'>
            <a href='../recherche_trajet/accueil.php'>
                <img class='image-logo' src='../img/logoomnesvert-1.png' alt='BlaBla Omnes'>
            </a>
        </div>
        <div class='hidden sm:block'>
            <a href='../recherche_trajet/accueil.php'>
                <img class='image-logo-blabla' src='../img/logo_blabla_omnes.png' alt='BlaBla Omnes'>
            </a>

        </div>
        <div class='flex flex-row items-center'>

            <div class='hidden sm:block'>

                <div class='flex flex-row'>
                    <div class='chercher-trajet'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' viewBox='0 0 28 28' fill='none'>
                            <path d='M9.33917 15.1667C9.33917 15.4761 9.21625 15.7728 8.99746 15.9916C8.77867 16.2104 8.48192 16.3333 8.1725 16.3333C7.86308 16.3333 7.56633 16.2104 7.34754 15.9916C7.12875 15.7728 7.00583 15.4761 7.00583 15.1667C7.00583 14.8573 7.12875 14.5605 7.34754 14.3417C7.56633 14.1229 7.86308 14 8.1725 14C8.48192 14 8.77867 14.1229 8.99746 14.3417C9.21625 14.5605 9.33917 14.8573 9.33917 15.1667ZM19.8333 16.3333C20.1428 16.3333 20.4395 16.2104 20.6583 15.9916C20.8771 15.7728 21 15.4761 21 15.1667C21 14.8573 20.8771 14.5605 20.6583 14.3417C20.4395 14.1229 20.1428 14 19.8333 14C19.5239 14 19.2272 14.1229 19.0084 14.3417C18.7896 14.5605 18.6667 14.8573 18.6667 15.1667C18.6667 15.4761 18.7896 15.7728 19.0084 15.9916C19.2272 16.2104 19.5239 16.3333 19.8333 16.3333ZM11.0647 17.2083C11.0647 16.9763 11.1569 16.7537 11.3209 16.5896C11.485 16.4255 11.7076 16.3333 11.9397 16.3333H16.0055C16.2376 16.3333 16.4601 16.4255 16.6242 16.5896C16.7883 16.7537 16.8805 16.9763 16.8805 17.2083C16.8805 17.4404 16.7883 17.663 16.6242 17.8271C16.4601 17.9912 16.2376 18.0833 16.0055 18.0833H11.9397C11.7076 18.0833 11.485 17.9912 11.3209 17.8271C11.1569 17.663 11.0647 17.4404 11.0647 17.2083ZM10.8103 2.32401C10.5783 2.32401 10.3557 2.41619 10.1916 2.58029C10.0275 2.74438 9.93533 2.96694 9.93533 3.19901V5.25001H9.16067C8.34776 5.24975 7.55629 5.51075 6.90301 5.99452C6.24972 6.47829 5.7692 7.15921 5.53233 7.93684L5.4635 8.16667H4.375C4.14294 8.16667 3.92038 8.25886 3.75628 8.42295C3.59219 8.58705 3.5 8.80961 3.5 9.04167C3.5 9.27374 3.59219 9.49629 3.75628 9.66039C3.92038 9.82448 4.14294 9.91667 4.375 9.91667H4.99683L4.76117 10.8815C4.37593 11.1156 4.05752 11.445 3.83662 11.838C3.61571 12.231 3.49978 12.6742 3.5 13.125V23.0417C3.5 24.1687 4.41467 25.0833 5.54167 25.0833H7.29167C7.83315 25.0833 8.35246 24.8682 8.73534 24.4853C9.11823 24.1025 9.33333 23.5832 9.33333 23.0417V21.5833H18.6667V23.0417C18.6667 24.1687 19.5813 25.0833 20.7083 25.0833H22.4583C22.9998 25.0833 23.5191 24.8682 23.902 24.4853C24.2849 24.1025 24.5 23.5832 24.5 23.0417V13.125C24.5 12.1742 23.9937 11.34 23.2365 10.8803L22.9962 9.91667H23.625C23.8571 9.91667 24.0796 9.82448 24.2437 9.66039C24.4078 9.49629 24.5 9.27374 24.5 9.04167C24.5 8.80961 24.4078 8.58705 24.2437 8.42295C24.0796 8.25886 23.8571 8.16667 23.625 8.16667H22.526L22.4618 7.952C22.2275 7.17097 21.7476 6.4863 21.0934 5.99957C20.4391 5.51283 19.6454 5.24998 18.83 5.25001H18.0833V3.19901C18.0833 2.96694 17.9911 2.74438 17.8271 2.58029C17.663 2.41619 17.4404 2.32401 17.2083 2.32401H10.8103ZM16.3333 5.25001H11.6853V4.07401H16.3333V5.25001ZM9.16067 7H18.83C19.269 7.00004 19.6963 7.14159 20.0486 7.40366C20.4008 7.66572 20.6591 8.03434 20.7853 8.45484L21.0303 9.27384L21.3383 10.5H6.65583L6.95567 9.27267L7.20767 8.44667C7.33519 8.02808 7.59383 7.66154 7.94545 7.40108C8.29708 7.14061 8.72308 7.00001 9.16067 7ZM5.25 19.8333V13.125C5.25 12.8929 5.34219 12.6704 5.50628 12.5063C5.67038 12.3422 5.89294 12.25 6.125 12.25H21.875C22.1071 12.25 22.3296 12.3422 22.4937 12.5063C22.6578 12.6704 22.75 12.8929 22.75 13.125V19.8333H5.25ZM5.25 23.0417V21.5833H7.58333V23.0417C7.58333 23.119 7.5526 23.1932 7.49791 23.2479C7.44321 23.3026 7.36902 23.3333 7.29167 23.3333H5.54167C5.46431 23.3333 5.39013 23.3026 5.33543 23.2479C5.28073 23.1932 5.25 23.119 5.25 23.0417ZM22.75 21.5833V23.0417C22.75 23.119 22.7193 23.1932 22.6646 23.2479C22.6099 23.3026 22.5357 23.3333 22.4583 23.3333H20.7083C20.631 23.3333 20.5568 23.3026 20.5021 23.2479C20.4474 23.1932 20.4167 23.119 20.4167 23.0417V21.5833H22.75Z'
                                  fill='black'/>
                        </svg>
                        <?php
                            if(isset($_SESSION['profil_id'])){
                                echo "<a class='font-manrope px-2 mt-0.5 hover:underline' href='../recherche_trajet/recherche.php'>Chercher un trajet</a>";
                            }
                            else{
                                echo "<a class='font-manrope px-2 mt-0.5 hover:underline' href='../compte/compte.php'>Chercher un trajet</a>";
                            }
                        ?>

                    </div>
                    <div class='chercher-trajet'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' viewBox='0 0 28 28' fill='none'>
                            <path d='M12.833 19.8333H15.1663V15.1667H19.833V12.8333H15.1663V8.16668H12.833V12.8333H8.16634V15.1667H12.833V19.8333ZM13.9997 25.6667C12.3858 25.6667 10.8691 25.3602 9.44968 24.7473C8.03023 24.1352 6.79551 23.3042 5.74551 22.2542C4.69551 21.2042 3.86445 19.9695 3.25234 18.55C2.63945 17.1306 2.33301 15.6139 2.33301 14C2.33301 12.3861 2.63945 10.8695 3.25234 9.45001C3.86445 8.03057 4.69551 6.79584 5.74551 5.74584C6.79551 4.69584 8.03023 3.8644 9.44968 3.25151C10.8691 2.6394 12.3858 2.33334 13.9997 2.33334C15.6136 2.33334 17.1302 2.6394 18.5497 3.25151C19.9691 3.8644 21.2038 4.69584 22.2538 5.74584C23.3038 6.79584 24.1349 8.03057 24.747 9.45001C25.3599 10.8695 25.6663 12.3861 25.6663 14C25.6663 15.6139 25.3599 17.1306 24.747 18.55C24.1349 19.9695 23.3038 21.2042 22.2538 22.2542C21.2038 23.3042 19.9691 24.1352 18.5497 24.7473C17.1302 25.3602 15.6136 25.6667 13.9997 25.6667ZM13.9997 23.3333C16.6052 23.3333 18.8122 22.4292 20.6205 20.6208C22.4288 18.8125 23.333 16.6056 23.333 14C23.333 11.3945 22.4288 9.18751 20.6205 7.37918C18.8122 5.57084 16.6052 4.66668 13.9997 4.66668C11.3941 4.66668 9.18717 5.57084 7.37884 7.37918C5.57051 9.18751 4.66634 11.3945 4.66634 14C4.66634 16.6056 5.57051 18.8125 7.37884 20.6208C9.18717 22.4292 11.3941 23.3333 13.9997 23.3333Z'
                                  fill='black'/>
                        </svg>
                        <?php if(isset($_SESSION['profil_id'])){
                            echo "<a class='font-manrope px-2 mt-0.5 hover:underline' href='../publier_trajet/traitementPermisValide.php'>Publier un trajet</a>";
                        }
                        else{
                            echo "<a class='font-manrope px-2 mt-0.5 hover:underline' href='../compte/compte.php'>Publier un trajet</a>";
                        }?>
                        <!--Différencier les liens si connecté ou non--->
                    </div>
                    <div class='chercher-trajet'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='27' height='25' viewBox='0 0 27 25' fill='none'>
                            <g clip-path='url(#clip0_273_27)'>
                                <path d='M5.08594 24.5508C6.66797 24.5508 9.90234 22.957 12.2812 21.2578C20.4492 21.4805 26.5781 16.793 26.5781 10.6523C26.5781 4.75781 20.6719 0 13.2891 0C5.90625 0 0 4.75781 0 10.6523C0 14.4961 2.46094 17.9062 6.16406 19.6172C5.63672 20.6367 4.65234 22.0195 4.125 22.7109C3.50391 23.5312 3.87891 24.5508 5.08594 24.5508ZM6.31641 22.6055C6.22266 22.6406 6.1875 22.5703 6.24609 22.4883C6.90234 21.6797 7.83984 20.4609 8.23828 19.7109C8.56641 19.1016 8.48438 18.5625 7.73438 18.2109C4.05469 16.5 1.94531 13.7695 1.94531 10.6523C1.94531 5.84766 6.97266 1.93359 13.2891 1.93359C19.6172 1.93359 24.6445 5.84766 24.6445 10.6523C24.6445 15.4453 19.6172 19.3594 13.2891 19.3594C13.0547 19.3594 12.6914 19.3477 12.2227 19.3359C11.7305 19.3359 11.3555 19.4883 10.9102 19.8398C9.46875 20.8828 7.38281 22.1719 6.31641 22.6055Z'
                                      fill='black'/>
                                <path d='M13.3008 4.79297C12.7969 4.79297 12.4219 5.16797 12.4219 5.67188V11.543L12.5156 14.0039L11.3438 12.5977L9.94921 11.2031C9.79688 11.0391 9.57422 10.9453 9.32812 10.9453C8.84766 10.9453 8.48438 11.3086 8.48438 11.7891C8.48438 12.0234 8.55469 12.2344 8.70703 12.3867L12.6211 16.2891C12.8555 16.5234 13.0547 16.6172 13.3008 16.6172C13.5703 16.6172 13.7695 16.5117 13.9922 16.2891L17.8945 12.3867C18.0469 12.2344 18.1406 12.0234 18.1406 11.7891C18.1406 11.3086 17.7656 10.9453 17.2852 10.9453C17.0273 10.9453 16.8164 11.0273 16.6641 11.2031L15.2812 12.5977L14.0859 14.0273L14.1797 11.543V5.67188C14.1797 5.16797 13.8164 4.79297 13.3008 4.79297Z'
                                      fill='black'/>
                            </g>
                            <defs>
                                <clipPath id='clip0_273_27'>
                                    <rect width='26.5781' height='24.5508' fill='white'/>
                                </clipPath>
                            </defs>
                        </svg>
                        <?php
                        if(isset($_SESSION['profil_id'])){
                            echo "<a class='font-manrope px-2 mt-0.5 hover:underline' href='..\mes_trajets\mes_trajets.php'>Mes trajets</a>";
                        }
                        else{
                            echo "<a class='font-manrope px-2 mt-0.5 hover:underline' href='..\compte\compte.php'>Mes trajets</a>";
                        }
                        ?>
                        <!--Mettre bon lien mes trajets--->
                        <!-- Structure pour les notifications : affichée uniquement si connecté -->
                        <?php if (isset($_SESSION['profil_id'])): ?>
                            <div class="notifications-container">
                                <?php include("../notifications/traitementNotifications.php"); ?>
                            </div>
                            <!-- Ajout de l'icône de notification -->
                            <div class='notification-icon'>
                                <img src="../img/bell.png">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class='img-profile'>
                <?php include("traitementHeader.php"); ?>
            </div>
        </div>
    </div>

</header>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notificationIcon = document.querySelector('.notification-icon');
        const notificationsContainer = document.querySelector('.notifications-container');

        if (notificationIcon && notificationsContainer) {
            notificationIcon.addEventListener('click', function() {
                if (notificationsContainer.style.display === 'block') {
                    notificationsContainer.style.display = 'none';
                } else {
                    notificationsContainer.style.display = 'block';
                }
            });
        }
    });
</script>