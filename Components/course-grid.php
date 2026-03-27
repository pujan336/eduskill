<?php

/** @var array<int, array<string, string>> $course_list */
if (!isset($ROOT)) {
    require_once __DIR__ . '/paths.php';
}
foreach ($course_list as $course) {
    $img = htmlspecialchars($ROOT . 'image/' . $course['img']);
    $title = htmlspecialchars($course['title']);
    $desc = htmlspecialchars($course['desc']);
    $rating = $course['rating'];
    $value = htmlspecialchars($course['value']);
    $isFree = ($course['price'] ?? '') === 'free';
    $priceClass = $isFree ? 'price-free' : 'price-paid';
    $priceText = $isFree ? 'Free' : htmlspecialchars($course['label'] ?? '$49');
    ?>
    <article class="course-card">
        <img src="<?php echo $img; ?>" alt="">
        <div class="course-body">
            <h3><?php echo $title; ?></h3>
            <p><?php echo $desc; ?></p>
            <div class="rating" aria-hidden="true"><?php echo $rating; ?></div>
            <span class="price-tag <?php echo $priceClass; ?>"><?php echo $priceText; ?></span>
            <form method="post" action="<?php echo htmlspecialchars($ROOT); ?>index.php#courses">
                <input type="hidden" name="course_name" value="<?php echo $value; ?>">
                <button type="submit" class="enroll-btn">Enroll now</button>
            </form>
        </div>
    </article>
    <?php
}
