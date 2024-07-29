<div class="side-bar">
    <a href="" class="brand-logo-text">
        Super-market
    </a>
    <br /><br /><br />

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
                <div @class([isset($page) && $page === "products" ? "active" : ""])>
                    Liste des produits
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('products.create') }}">
                <div @class([isset($page) && $page === "products.create" ? "active" : ""])>
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
                <div @class([isset($page) && $page === "categories" ? "active" : ""])>
                    Liste des catégories
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.create') }}">
                <div @class([isset($page) && $page === "categories.create" ? "active" : ""])>
                    Créer une nouvelle catégorie
                </div>
            </a>
        </li>
    </ul>
</div>