a:5:{i:0;s:266:"<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->tag->gettitle() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->assets->outputCss('style') ?>
    <?= $this->assets->outputJs('js') ?>
    ";s:4:"head";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:6:"

    ";s:4:"file";s:32:"../app/views/templates/base.volt";s:4:"line";i:11;}}i:1;s:1288:"
</head>
<body>
    <div class="navbar navbar-default">
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
          <a class="navbar-brand" href="/">Fireball</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= $this->url->get('signin/index') ?>">Signin</a>
              </li>
            </ul>
          </div>
        </nav>
        </div>
    </div>

    <div class="container">
        <?= $this->flash->output() ?>

        <div>
        ";s:7:"content";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:10:"

        ";s:4:"file";s:32:"../app/views/templates/base.volt";s:4:"line";i:47;}}i:2;s:42:"
        </div>
    </div>
</body>
</html>";}