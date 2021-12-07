<?php
class NavBar
{
    protected $html;

    public function beginNavBar() : string
    {
        return "
        <nav class='navbar navbar-dark bg-dark navbar-expand-md'>
            <a href='/' class='navbar-brand'>PBank</a>
            <button class='navbar-toggler' data-bs-toggle='collapse' data-bs-target='#navbar'>
                <span class='navbar-toggler-icon'></span>
            </button>
        ";
    }

    public function beginNavItems()  : string
    {
        return "
            <div class='navbar-collapse collapse' id='navbar'>
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
        return '
                    </ul>
                </div>
        ';
    }

    public function endNavBar() : string
    {
        return '
            </div>
        </nav>';
    }

    public function generate($html) : void
    {
        echo $html;
    }
}