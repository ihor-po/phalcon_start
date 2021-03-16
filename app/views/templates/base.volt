<!DOCTYPE html>
<html lang="en">
<head>
    {{ getTitle() }}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ this.assets.outputCss('style') }}
    {{ this.assets.outputJs('js') }}
    {% block head %}

    {% endblock %}
</head>
<body>
    <div class="navbar navbar-default">
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Fireball</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Si</a>
              </li>
            </ul>
          </div>
        </nav>
        </div>
    </div>


    {% block content %}

    {% endblock %}
</body>
</html>