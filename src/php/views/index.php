<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Sustainable Earth Foundation</title>
  <link rel="stylesheet" href="../../css/header_footer.css">
  <link rel="stylesheet" href="../../css/home.css">
  <link rel="shortcut icon" href="../../assets/icons/favicon.png" type="image/x-icon">
  <?php require_once '../components/session.php'; ?>
</head>

<body>
  <?php require_once '../components/header.php'; ?>
  <main>
    <section id="hero">
      <div>
        <span id="sdg11" class="btn">SDG 11</span>
        <div id="goals">
          <h2>Goals:</h2>
          <p>Make cities and human settlements inclusive, safe, resilient and sustainable</p>
        </div>
      </div>
      <img src="../../assets/images/infographics.jpg" alt="Infographics">
    </section>
    <div class="after-hero">
      <section id="targets-indicators">
        <div>
          <h2>Targets & Indicators</h2>
          <p>Mouse over each dot for more info</p>
        </div>
        <div id="targets-grid">
          <span>11.1</span>
          <span>11.2</span>
          <span>11.3</span>
          <span>11.4</span>
          <span>11.5</span>
          <span>11.6</span>
          <span>11.7</span>
          <span>11.a</span>
          <span>11.b</span>
          <span>11.c</span>
        </div>
      </section>
      <figure id="interlinkage">
        <img src="../../assets/images/interlinkages.jpg" alt="Interlinkage">
        <figcaption>To achieve SDG 11, efforts must focus on strengthening capacities for planning
          for urban development, improving access to public transportation and enhancing waste
          management.</figcaption>
      </figure>
    </div>
    <section id="timeline">
      <div class="top">
        <h2>Timeline</h2>
        <p>The Sustainable Development Goals (SDGs) were born at the United Nations Conference on Sustainable Development in Rio de Janeiro in 2012.</p>
      </div>
      <ul>
        <li class="achievement">
          <span class="timeline-num">1</span>
          <h3 class="timeline-year">2000</h3>
          <p class="timeline-desc">Millennium Development Goals (MDGs) were established, providing a framework for global development until 2015.</p>
        </li>
        <li class="achievement">
          <span class="timeline-num">2</span>
          <h3 class="timeline-year">2012</h3>
          <p class="timeline-desc">The United Nations Conference on Sustainable Development (Rio+20) took place in Rio de Janeiro, Brazil. This conference led to the proposal of the SDGs as a successor framework to the MDGs.</p>
        </li>
        <li class="achievement">
          <span class="timeline-num">3</span>
          <h3 class="timeline-year">2015</h3>
          <p class="timeline-desc">The United Nations General Assembly formally adopted the 2030 Agenda for Sustainable Development, which require_onced the 17 Sustainable Development Goals, along with 169 targets and 232 indicators. </p>
        </li>
        <li class="achievement">
          <span class="timeline-num">4</span>
          <h3 class="timeline-year">2016</h3>
          <p class="timeline-desc">The High-level Political Forum on Sustainable Development (HLPF) was established as the central UN platform for the follow-up and review of the SDGs.</p>
        </li>
        <li class="achievement">
          <span class="timeline-num">5</span>
          <h3 class="timeline-year">2019</h3>
          <p class="timeline-desc">The first comprehensive review of SDG progress was conducted during the UN's SDG Summit held in New York, which took place from September 24-25.</p>
        </li>
        <li class="achievement">
          <span class="timeline-num">6</span>
          <h3 class="timeline-year">2020</h3>
          <p class="timeline-desc">The COVID-19 pandemic significantly disrupted progress towards the SDGs, highlighting the need for more concerted efforts and global cooperation to achieve the goals by 2030.</p>
        </li>
      </ul>
      <p class="bottom">The SDGs remain a critical framework for addressing some of the world's most pressing challenges and guiding international efforts to create a more sustainable and equitable world by 2030.</p>
    </section>
    <section id="purposes">
      <h2>Purposes</h2>
      <div>
        <img src="../../assets/images/prosperity.png" alt="Prosperity" class="purposes-img">
        <img src="../../assets/images/protect_earth.png" alt="Protect the Earth" class="purposes-img">
        <img src="../../assets/images/health.png" alt="Love Health" class="purposes-img">
        <img src="../../assets/images/poverty.png" alt="Poverty" class="purposes-img">
        <img src="../../assets/images/inequality.png" alt="End Equality" class="purposes-img">
      </div>
      <p>The Sustainable Development Goals (SDGs) aim to transform our world.</p>
    </section>
    <section id="upcoming">
      <h2>Upcoming Events</h2>
      <ul>
        <li class="event">
          <span class="event-date">Jan<br>30</span>
          <p class="event-desc">2024 ECOSOC Partnership Forum</p>
          <button>
            <img src="../../assets/icons/chevron_triple_right/chevron_triple_right.svg" alt="Chevron">
          </button>
        </li>
        <li class="event">
          <span class="event-date">Sep<br>13</span>
          <p class="event-desc">Launch of the First Global Report on Climate and SDGs Synergies</p>
          <button>
            <img src="../../assets/icons/chevron_triple_right/chevron_triple_right.svg" alt="Chevron">
          </button>
        </li>
        <li class="event">
          <span class="event-date">Sep<br>19</span>
          <p class="event-desc">2023 SDG Summit</p>
          <button>
            <img src="../../assets/icons/chevron_triple_right/chevron_triple_right.svg" alt="Chevron">
          </button>
        </li>
        <li class="event">
          <span class="event-date">Oct<br>12</span>
          <p class="event-desc">Workshop - Building Capacity and Scaling Up Adoption of STI4SDGs Roadmaps in Africa</p>
          <button>
            <img src="../../assets/icons/chevron_triple_right/chevron_triple_right.svg" alt="Chevron">
          </button>
        </li>
      </ul>
    </section>
  </main>
  <?php require_once '../components/footer.php'; ?>
</body>

</html>