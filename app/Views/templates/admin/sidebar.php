<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
            <a href="<?= base_url('/admin'); ?>"><img src="<?= base_url('/assets/brand/logo-blanc.svg'); ?>" class="sidebar-brand-full" _width="88"
            height="32"
            alt="Mon Projet" /></a>
            <a href="<?= base_url('/admin'); ?>"><img src="<?= base_url('/assets/brand/logo-blanc.svg'); ?>" class="sidebar-brand-narrow" _width="32"
                 height="32"
                 alt="Mon Projet" /></a>
            Mon Projet
        </div>
        <a href="<?= base_url(); ?>" target="_blank" class="header-toggler" alt="Voir le site" title="Voir le site"><i class="fa-solid fa-house-laptop"></i></a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <?php
        foreach ($menus as $km => $menu) {
            if (isset($menu['admin']) && ! $user->isAdmin()) { continue; }
            if (isset($menu['require']) && ! $user->check($menu['require'])) { continue; }
            if (!isset($menu['subs'])) { ?>
                <li class="nav-item <?= ($localmenu === $km ? 'active' : '') ?>"
                    id="menu_<?= $km ?>">
                    <a class="nav-link" href="<?= base_url($menu['url']) ?>">
                        <?php if (isset($menu['icon'])) { echo $menu['icon']; }
                        else { ?><svg class="nav-icon"><span class="bullet bullet-dot"></svg><?php } ?>
                        <?= $menu['title'] ?>
                    </a>
                </li>
            <?php } else { ?>
                <li class="nav-group">
                    <a class="nav-link nav-group-toggle" href="#">
                        <?= (isset($menu['icon'])) ? $menu['icon'] : ""; ?>
                        <?= $menu['title'] ?></a>
                    <ul class="nav-group-items compact">
                        <?php
                        foreach($menu['subs'] as $ksm => $smenu) {

                            if (isset($smenu['admin']) && ! $user->isAdmin()) { continue; }
                            if (isset($smenu['require']) && ! $user->check($smenu['require'])) { continue; } ?>
                            <li class="nav-item ps-2" id="menu_<?= $ksm ?>"><a class="nav-link" href="<?= base_url($smenu['url']); ?>">
                                    <?php if (isset($smenu['icon'])) echo $smenu['icon']; ?>
                                    <?= $smenu['title'] ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }} ?>

        <li class="nav-item mt-auto">
            <a class="nav-link" href="<?= base_url('/login/logout'); ?>">
                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Déconnexion</a>
        </li>
    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <small>Version :</small>
    </div>
</div>