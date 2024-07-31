<div class="side-bar">
    <a href="" class="brand-logo-text">
        Super-market
    </a>
    <br /><br />
    

    <ul>
        <li>
            <small>
                <i class="fas fa-user"></i>
                &nbsp;
                <b id="user-name" style="cursor: pointer;">{{ Auth::user()->name }}</b>
            </small>
        </li>
    </ul>
    
    <ul id="edit-profile-button" class="hidden">
        <style>
            .hidden {
                display: none;
            }
        </style>
        <li>
            <a href="{{ route('profiles.edit', ['id' => Auth::user()->id]) }}">
                <div class="button primary">
                    Editer le profil
                </div>
            </a>
        </li>
    </ul>

    <script>
        document.getElementById('user-name').addEventListener('click', function() {
            document.getElementById('edit-profile-button').classList.toggle('hidden');
        });
    </script>

    <ul>
        <li>
            <small>
                <i class="fas fa-cart-arrow-down"></i>
                &nbsp;
                <b>Gestion de produits</b>
            </small>
        </li>
    </ul>

    <ul>
        <li>
            <a href="{{ route('products.index') }}">
                <div @class([isset($page) && $page === 'products' ? 'active' : ''])>
                    Liste des produits
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('products.create') }}">
                <div @class([isset($page) && $page === 'products.create' ? 'active' : ''])>
                    Créer un nouveau produit
                </div>
            </a>
        </li>
    </ul>

    <ul>
        <li>
            <small>
                <i class="fa fa-boxes-packing"></i>
                &nbsp;
                <b>Gestion de catégories</b>
            </small>
        </li>
    </ul>

    <ul>
        <li>
            <a href="{{ route('categories.index') }}">
                <div @class([isset($page) && $page === 'categories' ? 'active' : ''])>
                    Liste des catégories
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.create') }}">
                <div @class([
                    isset($page) && $page === 'categories.create' ? 'active' : '',
                ])>
                    Créer une nouvelle catégorie
                </div>
            </a>
        </li>
    </ul>



    <ul>
        <li>
            <small>
                <i class="fa fa-dollar"></i>
                &nbsp;
                <b>Gestion de ventes</b>
            </small>
        </li>
    </ul>

    <ul>
        <li>
            <a href="{{ route('sales.create') }}">
                <div @class([isset($page) && $page === "sales" ? "active" : ""])>
                    la vente d'un poduit
                </div>
            </a>
        </li>
        <li>
        <li>
            <a href="{{ route('categories.index') }}">
                <div @class([isset($page) && $page === "categories" ? "active" : ""])>
                    Facture de vente
                </div>
            </a>
        </li>
        <li>
        <a href="{{ route('categories.index') }}">
            <div @class([isset($page) && $page === "categories" ? "active" : ""])>
                Détails de la vente et bilan
            </div>
        </a>
        </li>
    </ul>


    <ul>
        <li>
            <small>
                <i class="fa fa-chart-line"></i>
                &nbsp;
                <b>Gestion de statistiques</b>
            </small>
        </li>
    </ul>

    <ul>
        <li>
            <a href="{{ route('home') }}">
                <div @class([isset($page) && $page === "categories" ? "active" : ""])>
                    Statistiques de produits par catégorie
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.create') }}">
                <div @class([isset($page) && $page === "categories.create" ? "active" : ""])>
                    Statistiques de vente de chaque mois/an
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.create') }}">
                <div @class([isset($page) && $page === "categories.create" ? "active" : ""])>
                    Statistiques des chiffres d'affaire global de chaque mois/an
                </div>
            </a>
        </li>
    </ul>
</div>

