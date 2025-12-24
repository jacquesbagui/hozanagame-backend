@extends('layouts.home')
@section('content')
    <div style="opacity: 1;">
        <div class="theme--night">
            <div style="height:1px;margin-top:-1px"></div>
            <div style="opacity: 1;">
                <div style="background-color:#dfdcce" class="pr">
                    <div class="pf top left right" style="background-color:#dfdcce;height:50vh"></div>
                    <div class="of--hidden">
                        <div class="grid-container contained pl1 pr1 pl8--md pr8--md pl9--lg pr9--lg pt6--md pb6--md">
                            <div class="row align--middle">
                                <div class="col c6--md">
                                    <div class="hide--md pt4 pb4 pr">
                                        <div class="pr">
                                            <div class="grid-container contained">
                                                <button class="db x" style="opacity: 1; transform: none;">
                                                    <div class="image size--1x1 contain">
                                                        <picture>
                                                            <source
                                                                srcset="https://res.cloudinary.com/ahoko/image/upload/v1652370813/W_jib8sq.png"
                                                                media="(min-width: 600px)">
                                                            <img
                                                                alt="Cards Against Humanity: Family Edition (Three-Quarter View of Box)"
                                                                src="https://res.cloudinary.com/ahoko/image/upload/v1652370813/W_jib8sq.png">
                                                        </picture>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-hero__desktop-image show--md">
                                        <button class="db x" style="opacity: 1; transform: none;">
                                            <div class="image size--1x1 contain">
                                                <picture>
                                                    <source
                                                        srcset="https://res.cloudinary.com/ahoko/image/upload/v1652370813/W_jib8sq.png"
                                                        media="(min-width: 600px)">
                                                    <img
                                                        alt="Hozana Game Worship"
                                                        src="https://res.cloudinary.com/ahoko/image/upload/v1652370813/W_jib8sq.png">
                                                </picture>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <div class="col c6--md">
                                    <div class="product-hero__card push-up">
                                        <div class="product-hero__content"><h1 id="product-family-edition"
                                                                               class="fw--800 fs--28 fs--40--md mb2">
                                                Hozana Game Worship</h1>
                                            <div class="rich-text line-break fs--16 fs--20--md fs--24--xl mb3">
                                                <div><p style="font-size: 18px">Hozana worship est un jeu de cartes
                                                        instructif basé sur des thématiques bibliques et vie chrétienne
                                                        jouable à 2 ou en groupe de manière linéaire.
                                                    </p>
                                                    <p style="font-size: 18px"><strong>Le jeu : </strong></p>
                                                    <p style="font-size: 18px">
                                                        Le joueur 1 engage la partie en tirant la première carte du lot.
                                                        Il impose la thématique contenu sur cette carte au joueur 2 qui
                                                        à son tour doit interpréter un chant en rapport avec celle-ci et
                                                        le chanter. Et ce en respectant le temps de recherche défini dès
                                                        l'entame par les deux joueurs.
                                                    </p>
                                                    <p style="font-size: 18px">
                                                        En cas de bonne réponse, le joueur 2 prend la main à son tour et
                                                        exécute le même cheminement.
                                                    </p>
                                                    <p style="font-size: 18px">
                                                        En cas de mauvaise réponse ou écoulement du temps de recherche
                                                        le joueur fautif s'expose automatiquement aux gages et pénalités
                                                        à exécuter obligatoirement.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="theme--night push-up">
                    <div class="theme--night pt5 pb5 pt9--lg pb9--lg of--hidden">
                        <div class="grid-container contained pl1 pr1 pl3--md pr3--md pl9--lg pr9--lg">
                            <div class="mb3 df fdr jcc jcb--md"><h2
                                    class="color--white fs--28 fs--40--md fw--800 tc tl--md">Règle de jeux</h2></div>
                            <strong>Pour jouer à Hozana Worship, il vous faut : </strong>
                            <p>Un lot de 52 cartes.</p>
                            <p>Un lot de cartes à gages.</p>
                            <p>Être au minimum 2 joueurs.</p>

                            <div>
                                <h3>
                                    <button aria-expanded="true" class="x tl df fdr jcb aic pt1 pb1 pt2--lg pb2--lg accordeon--button"
                                            name="toggle">
                                        <span class="db fs--20 fs--40--lg fw--800 pr2">Comment reconnaitre la bonne réponse ?</span>
                                        <svg class="fs0 db drawer__toggle show--lg show--md active" width="20"
                                             height="20" viewBox="0 0 20 20" fill="none">
                                            <rect x="9" width="2" height="20" fill="currentColor"></rect>
                                            <rect x="20" y="9" width="2" height="20" transform="rotate(90 20 9)"
                                                  fill="currentColor"></rect>
                                        </svg>
                                        <svg class="fs0 db drawer__toggle hide--lg active" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                            <rect x="7.19922" width="1.5" height="16" fill="currentColor"></rect>
                                            <rect x="16" y="7.19922" width="1.5" height="16"
                                                  transform="rotate(90 16 7.19922)" fill="currentColor"></rect>
                                        </svg>
                                    </button>
                                </h3>
                                <div
                                    style="height: 122px; transition: height 400ms cubic-bezier(0.12, 0.67, 0.53, 1) 0s;"
                                    class="of--hidden">
                                    <div>
                                        <div class="fs--homepage-faq rich-text line-break pb3 pl3--lg pb5--lg">
                                            <p>Devant chaque proposition de réponse est marquée une couleur. La bonne
                                                réponse est la proposition ayant la même couleur que la plume se
                                                trouvant au bas de la carte . </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg--white">
                            <div>
                                <h3>
                                    <button aria-expanded="false" class="x tl df fdr jcb aic pt1 pb1 pt2--lg pb2--lg accordeon--button"
                                            name="toggle"><span class="db fs--20 fs--40--lg fw--800 pr2">Commencer une partie à 2</span>
                                        <svg class="fs0 db drawer__toggle show--lg show--md" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none">
                                            <rect x="9" width="2" height="20" fill="currentColor"></rect>
                                            <rect x="20" y="9" width="2" height="20" transform="rotate(90 20 9)"
                                                  fill="currentColor"></rect>
                                        </svg>
                                        <svg class="fs0 db drawer__toggle hide--lg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                            <rect x="7.19922" width="1.5" height="16" fill="currentColor"></rect>
                                            <rect x="16" y="7.19922" width="1.5" height="16"
                                                  transform="rotate(90 16 7.19922)" fill="currentColor"></rect>
                                        </svg>
                                    </button>
                                </h3>
                                <div style="height:0;transition:height 400ms cubic-bezier(.12,.67,.53,1)"
                                     class="of--hidden">
                                    <div>
                                        <div class="fs--homepage-faq rich-text line-break pb3 pl3--lg pb5--lg">
                                            <p>
                                                Battez le lot de cartes.<br/>
                                                Le joueur 1 engage la partie en tirant la première carte du lot. Il impose la thématique contenu sur cette carte au joueur 2 qui à son tour doit interpréter  un chant en rapport avec celle-ci et le chanter. Et ce en respectant le temps de recherche défini dès l'entame par les deux joueurs.
                                            </p>
                                            <p>
                                                En cas de bonne réponse, le joueur 2 prend la main à son tour et exécute le même cheminement.
                                            </p>
                                            <p>
                                                En cas de mauvaise réponse ou écoulement du temps de recherche le joueur fautif s'expose automatiquement aux gages et pénalités à exécuter obligatoirement.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg--white">
                            <div>
                                <h3>
                                    <button aria-expanded="false" class="x tl df fdr jcb aic pt1 pb1 pt2--lg pb2--lg accordeon--button"
                                            name="toggle"><span class="db fs--20 fs--40--lg fw--800 pr2">Commencer une partie en équipes d'au moins 2 joueurs :</span>
                                        <svg class="fs0 db drawer__toggle show--lg show--md" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none">
                                            <rect x="9" width="2" height="20" fill="currentColor"></rect>
                                            <rect x="20" y="9" width="2" height="20" transform="rotate(90 20 9)"
                                                  fill="currentColor"></rect>
                                        </svg>
                                        <svg class="fs0 db drawer__toggle hide--lg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                            <rect x="7.19922" width="1.5" height="16" fill="currentColor"></rect>
                                            <rect x="16" y="7.19922" width="1.5" height="16"
                                                  transform="rotate(90 16 7.19922)" fill="currentColor"></rect>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="of--hidden"
                                     style="height: 0px; transition: height 400ms cubic-bezier(0.12, 0.67, 0.53, 1) 0s;" sizeHeight="full">
                                    <div>
                                        <div class="fs--homepage-faq rich-text line-break pb3 pl3--lg pb5--lg">
                                            <p>Battez le lot de cartes.</p>
                                            <p>
                                                L'équipe 1 engage la partie en piochant la première carte du lot. L'équipe 2 désigne un représentant chargé d'interpréter un chant en rapport avec la thématique contenue sur la carte piochée.  Et ce dans le respect  du temps de recherche défini dès l'entame par les deux équipes.
                                            </p>
                                            <p>
                                                En cas de bonne réponse, l'équipe 2 prend la main à son tour et exécute le même cheminement.
                                            </p>
                                            <p>
                                                En cas de mauvaise réponse ou écoulement du temps de recherche , le joueur fautif expose automatiquement son équipe aux gages et pénalités à exécuter obligatoirement.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg--white">
                            <div>
                                <h3>
                                    <button aria-expanded="false" class="x tl df fdr jcb aic pt1 pb1 pt2--lg pb2--lg accordeon--button"
                                            name="toggle"><span class="db fs--20 fs--40--lg fw--800 pr2">Gages et pénalités</span>
                                        <svg class="fs0 db drawer__toggle show--lg show--md" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none">
                                            <rect x="9" width="2" height="20" fill="currentColor"></rect>
                                            <rect x="20" y="9" width="2" height="20" transform="rotate(90 20 9)"
                                                  fill="currentColor"></rect>
                                        </svg>
                                        <svg class="fs0 db drawer__toggle hide--lg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                            <rect x="7.19922" width="1.5" height="16" fill="currentColor"></rect>
                                            <rect x="16" y="7.19922" width="1.5" height="16"
                                                  transform="rotate(90 16 7.19922)" fill="currentColor"></rect>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="of--hidden"
                                     style="height: 0px; transition: height 400ms cubic-bezier(0.12, 0.67, 0.53, 1) 0s;" sizeHeight="medium">
                                    <div>
                                        <div class="fs--homepage-faq rich-text line-break pb3 pl3--lg pb5--lg">
                                            <p>
                                                <strong>Dans une partie avec des cartes à gages.</strong>
                                            </p>
                                            <p>
                                                Le joueur fautif ou représentant de l'équipe fautive pioche la première carte et exécute obligatoirement le gage après mélange du lot de cartes.
                                            </p>
                                            <p>
                                                <strong>Dans une partie avec pénalités</strong>
                                            </p>
                                            <p>
                                                Le joueur fautif ou l'équipe fautive se verra retrancher un point de son nombre total de points.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg--white">
                            <div>
                                <h3>
                                    <button aria-expanded="false" class="x tl df fdr jcb aic pt1 pb1 pt2--lg pb2--lg accordeon--button"
                                            name="toggle"><span class="db fs--20 fs--40--lg fw--800 pr2">Carte avec QR code : mode de fonctionnement </span>
                                        <svg class="fs0 db drawer__toggle show--lg show--md" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none">
                                            <rect x="9" width="2" height="20" fill="currentColor"></rect>
                                            <rect x="20" y="9" width="2" height="20" transform="rotate(90 20 9)"
                                                  fill="currentColor"></rect>
                                        </svg>
                                        <svg class="fs0 db drawer__toggle hide--lg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                            <rect x="7.19922" width="1.5" height="16" fill="currentColor"></rect>
                                            <rect x="16" y="7.19922" width="1.5" height="16"
                                                  transform="rotate(90 16 7.19922)" fill="currentColor"></rect>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="of--hidden"
                                     style="height: 0px; transition: height 400ms cubic-bezier(0.12, 0.67, 0.53, 1) 0s;">
                                    <div>
                                        <div class="fs--homepage-faq rich-text line-break pb3 pl3--lg pb5--lg">
                                            <p>
                                                Dans une partie si un joueur pioche une carte à QR code ce joueur devra  scanner le Code se trouvant sur la carte afin de voir la question masquée.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg--white">
                            <div>
                                <h3>
                                    <button aria-expanded="false" class="x tl df fdr jcb aic pt1 pb1 pt2--lg pb2--lg accordeon--button"
                                            name="toggle"><span class="db fs--20 fs--40--lg fw--800 pr2">Comment scanner le QR code ?</span>
                                        <svg class="fs0 db drawer__toggle show--lg show--md" width="20" height="20"
                                             viewBox="0 0 20 20" fill="none">
                                            <rect x="9" width="2" height="20" fill="currentColor"></rect>
                                            <rect x="20" y="9" width="2" height="20" transform="rotate(90 20 9)"
                                                  fill="currentColor"></rect>
                                        </svg>
                                        <svg class="fs0 db drawer__toggle hide--lg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                            <rect x="7.19922" width="1.5" height="16" fill="currentColor"></rect>
                                            <rect x="16" y="7.19922" width="1.5" height="16"
                                                  transform="rotate(90 16 7.19922)" fill="currentColor"></rect>
                                        </svg>
                                    </button>
                                </h3>
                                <div class="of--hidden"
                                     style="height: 0px; transition: height 400ms cubic-bezier(0.12, 0.67, 0.53, 1) 0s;" sizeHeight="medium">
                                    <div>
                                        <div class="fs--homepage-faq rich-text line-break pb3 pl3--lg pb5--lg">
                                            <p>
                                                Avec un smartphone Android ou ios connecté à internet , servez-vous de la caméra pour scanner le  code . Vous pourrez éventuellement utiliser une application de Scan disponible gratuitement sur Google Play ou Apple store .
                                                En cas d’erreur après un Scan vérifiez votre connexion internet et réessayer.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg--white">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
