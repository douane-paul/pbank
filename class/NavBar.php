<?php
class NavBar
{
    protected $html;

    public function beginNavBar() : string
    {
        return "
        <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='/'>PBank</a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
        ";
    }

    public function beginNavItems()  : string
    {
        return "
                <div class='collapse navbar-collapse' id='navbarNavDropdown'>
                    <ul class='navbar-nav'>
        ";
    }

    public function navItem($active, $name, $href = NULL) : string
    {
        if ($active) {
            return "
                        <li class='nav-item'>
                            <a class='nav-link active' aria-current='page' href='/$href'>$name</a>
                        </li>
            ";
        } else {
            return "
                        <li class='nav-item'>
                            <a class='nav-link' aria-current='page' href='/$href'>$name</a>
                        </li>
            ";
        }
    }

    public function endNavItems()  : string
    {
        return "
                    </ul>
                </div>
        ";
    }

    public function endNavBar() : string
    {
        return "
            </div>
        </nav>";
    }

    public function generate($html) : void
    {
        echo $html;
    }
}