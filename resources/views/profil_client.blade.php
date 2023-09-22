@extends("master")

@php
    $displayMenu = 0;
    if (request()->has('displayMenu'))
        $displayMenu = request()->displayMenu
@endphp

@section('head')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section("content")
    <style type="text/tailwindcss">
        @layer components {
            .nav {
                @apply fixed w-full h-screen flex bg-[#70ad42] text-white items-center justify-center relative;

                a {
                    > .navlinks {
                        @apply flex flex-col items-center justify-center p-4 cursor-pointer transition-all rounded-lg mr-4 ;

                        &:hover {
                            @apply bg-white text-[#70ad42] font-extrabold shadow-md ;
                        }

                        > i {
                            @apply text-[2rem] ;
                        }
                    }

                    .navlinks-actif {
                        @apply bg-white text-[#70ad42] ;
                    }
                }

                > .close {
                    @apply text-[1.5rem] cursor-pointer absolute top-[20px] right-[20px] ;
                }
            }
        }

    </style>
    @include("profil_client_views.components.nav", [
        "displayMenu" => $displayMenu,
        "navinfos" => array_combine(["person-circle", "buildings", "shop", "envelope", "power"], 
                                    ["Mon profil", "Mes sites", "Boutique", "Contact", "Deconnexion"]),
    ])


@endsection