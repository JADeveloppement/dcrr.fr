<div class="flex mb-3">
    <a href="/admin_pannel" class="text-sm text-primary hover:underline">
        Acceuil
    </a>
    <span class="text-sm text-secondary mx-3">></span>
    @switch(request()->displayMenu)
        @case(0)
        @break
        @case(1)
            
        @break
        @case(2)
            <span class="text-sm text-secondary">
                Liste des utilisateurs
            </span>
        @break
        @case(3)
            <span class="text-sm text-secondary">
                Liste des sites
            </span>
        @break
        @case(4)
            <span class="text-sm text-secondary">
                Actions à valider
            </span>
        @break
        @case(5)
            <span class="text-sm text-secondary">
                Sites
            </span>
        @break;
    @endswitch
</div>