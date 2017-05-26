<li>
    <?php if (isset($category['childs'])) : ?>
        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $category['name']; ?><span class="caret"></span></a>
    <?php else: ?>
    <a href=""><?php echo $category['name']; ?></a>
    <?php endif; ?>
    <?php if (isset($category['childs'])) : ?>
        <ul class="dropdown-menu">
            <?php echo $this->getMenuHtml($category['childs']); ?>
        </ul>
    <?php endif; ?>
</li>



                    