
<!-- KOD ZA BREADCRUMBS, title, link i active podesavanja su u potrebnim fajlovima-->

<ol class="breadcrumb">
    Ovde ste:
    <? foreach($breadcrumbs as $breadcrumb) : ?>
        <? if($breadcrumb['active']) : ?>
            <li class="active"><?=$breadcrumb['title']; ?></li>
        <? else : ?>
            <li><a href="<?=$breadcrumb['link']; ?>"><?=$breadcrumb['title']; ?></a></li>
        <? endif; ?>
    <? endforeach; ?>
</ol>