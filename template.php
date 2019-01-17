<!-- generator="<?php echo $generator ?>" -->
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">

  <channel>
    <title><?php echo Xml::encode($title) ?></title>
    <link><?php echo Xml::encode($link) ?></link>
    <language><?= $languagecode ?></language>
    <generator><?php echo c::get('feed.generator', 'Kirby') ?></generator>
    <lastBuildDate><?php echo date('r', $modified) ?></lastBuildDate>
    <atom:link href="<?php echo Xml::encode($url) ?>" rel="self" type="application/rss+xml" />

    <?php if(!empty($description)): ?>
    <description><?php echo Xml::encode($description) ?></description>
    <?php endif ?>

    <?php foreach($items as $item): ?>
    <item>
      <title><?php echo Xml::encode($item->title()) ?></title>
      <link><?php echo Xml::encode($item->url()) ?></link>
      <guid><?php echo Xml::encode($item->url()) ?></guid>
      <pubDate><?php echo $datefield == 'modified' ? $item->modified('r') : $item->$datefield()->toDate('r') ?></pubDate>
      <?php if (!empty($creatorfield)) : ?>
      <dc:creator><?= Xml::encode($item->{$creatorfield}()) ?></dc:creator>
      <?php endif ?>
      <?php if (!empty($enclosurefield) && '' != $item->{$enclosurefield}()) : ?>
      <?php if ($enclosureFile = $item->{$enclosurefield}()->toFile()) : ?>
      <enclosure url="<?= Xml::encode($enclosureFile->url()) ?>" length="<?= Xml::encode($enclosureFile->size()) ?>" type="<?= Xml::encode($enclosureFile->mime()) ?>" />
      <?php endif ?>
      <?php endif ?>
      <description><![CDATA[<?php echo $item->{$textfield}()->kirbytext() ?>]]></description>
    </item>
    <?php endforeach ?>

  </channel>
</rss>