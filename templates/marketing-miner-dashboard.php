<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Klíčová slova', 'marketing-miner' ); ?></h1>
    <?php
     $api_key = esc_attr( get_option( 'mm_api_key' ) );
if ($api_key){
        //ebd35110-cf35-4c86-900a-83056e5f7cf5

        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, "https://www.marketingminer.com/api/v1/project/$api_key/detail/dashboard");
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $keywordsList = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        if (!empty(json_decode($keywordsList, true)['increasing']))
		{
    		include dirname(__FILE__, 2) .'/templates/keywords-decreasing-header.html';

            $keywordsIncreasing = json_decode($keywordsList, true)['increasing'];



    foreach($keywordsIncreasing as $keyword):
        ?>
        <tr>
            <td class="text-capitalize "><?= $keyword['engine']; ?></td>
            <td><?= $keyword['keyword']; ?></td>
            <td>
                <?php if($keyword['position'] <= 10): ?>
                    <button class="btn btn-info btn-position text-center">
                        <?php if($keyword['position']==1) ?>
                            🏆
                        <?= $keyword['position']; ?>
                    </button>
                <?php else: ?>
                    <button class="btn btn-secondary btn-position text-center">
                        <?= $keyword['position']; ?>
                    </button>
                <?php endif; ?>
            </td>
            <td>
                <button class="btn btn-success btn-position text-center">
                    +<?= $keyword['position_change']; ?>
                </button>
            </td>
        </tr>
    <?php
    endforeach;

    include dirname(__FILE__, 2) .'/templates/keywords-increasing-footer.html';
    include dirname(__FILE__, 2) .'/templates/keywords-decreasing-header.html';
    echo '<br><br>';

    $keywordsDecreasing = json_decode($keywordsList, true)['decreasing'];
    foreach($keywordsDecreasing as $keyword): ?>
        <tr>
            <td class="text-capitalize"><?= $keyword['engine']; ?></td>
            <td><?= $keyword['keyword']; ?></td>
            <td>
                <?php if($keyword['position'] <= 10): ?>
                    <button class="btn btn-info btn-position text-center">
                        <?= $keyword['position']; ?>
                    </button>
                <?php else: ?>
                    <button class="btn btn-secondary btn-position text-center">
                        <?php if($keyword['position']>50): ?>
                            😥
                        <?php endif; ?>
                        <?= $keyword['position']; ?>
                    </button>
                <?php endif; ?>
            </td>
            <td>
                <button class="btn btn-danger btn-position text-center">
                    <?= $keyword['position_change']; ?>
                </button>
            </td>
        </tr>
    <?php
    endforeach;

    include dirname(__FILE__, 2) .'/templates/keywords-decreasing-footer.html'; ?>
</div>
<?php
}
else
{
	$admin_url = get_admin_url();
    echo "<a href=\"$admin_url/admin.php?page=marketing-miner-settings\"><strong>Wrong API</strong></a>";
}

}
else
{
	?>
	<a href="<?php echo get_admin_url();  ?>admin.php?page=marketing-miner-settings">Enter your API KEY here</a>
<?php
}
