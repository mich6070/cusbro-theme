<?php
/**
 * Statistics section
 */

$stats = [
    ['num' => '10+',   'label' => 'років на ринку'],
    ['num' => '5000+', 'label' => 'оформлених вантажів'],
    ['num' => '300+',  'label' => 'постійних клієнтів'],
    ['num' => '50+',   'label' => 'митних постів'],
];
?>

<section class="stats-section">
    <div class="container">
        <div class="stats__grid">
            <?php foreach ($stats as $stat) : ?>
            <div class="stat-item">
                <strong class="stat-item__num"><?php echo esc_html($stat['num']); ?></strong>
                <span class="stat-item__label"><?php echo esc_html($stat['label']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
