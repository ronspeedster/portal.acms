<?php
  require_once('process_post.php');
  include('sidebar.php');

  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  $_SESSION['getURI'] = $getURI;
  
  $getUsersSuggestion = mysqli_query($mysqli, "SELECT * FROM users
    WHERE (id NOT IN (SELECT from_user_id FROM user_links WHERE from_user_id = '$user_id')
    AND id NOT IN (SELECT to_user_id FROM user_links WHERE from_user_id = '$user_id'))
    AND
    (id NOT IN (SELECT from_user_id FROM user_links WHERE to_user_id = '$user_id')
    AND id NOT IN (SELECT to_user_id FROM user_links WHERE to_user_id = '$user_id'))
    AND id <> '$user_id'
    LIMIT 10");
?>
<title>Home</title>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php require('topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php
        if(isset($_SESSION['message'])){?>
          <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
          </div>
          <?php } ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tips</h1>
          </div>

          <div class="row">
            <div class="col-md-8" style="/* width: 70%;height:500px;background-color:green; */">
              <!-- Feed Container -->
              <div class="card shadow row mb-2" style="/*height:150px ; background-color: red;*/">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #1b5b3a;  ">
                    <h6 class="m-0 font-weight-bold" style="color: white;">4 Ways to survive a war</h6>
                  </div>                   
                 <div class="card-body">
                  Despite reassurances, many people still live or have lived in fear of the ravages of war. If you are keen to know how to survive during war, but don't know how, here is where you can learn how to protect yourself and others during a war.
                </div>
                </div>
              </div>
              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #bbf7d8;">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;">1. Know the area
                    </h6>
                  </div>
                  <div class="card-body">
                    <img src="img/tips/step-1.jpg" style="height: auto; width: 100%; border-radius: 5%; margin-bottom: 1%;">
                    Is it safe for you move into a different territory? Does it have fallout shelters or reliable sources of supplies? Of course, planning ahead can be most reliable because if a person knows everything about a place, it can be an advantage point. The following are the two common environments of survival, urban and rural. Both are discussed in the following steps. 
                  </div>
                </div>
              </div>

              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #bbf7d8;">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;">2. Be aware that urban cultures prove very difficult living conditions during prewar, wartime, and postwar times
                    </h6>
                  </div>
                  <div class="card-body">
                    <img src="img/tips/step-2.jpg" style="height: auto; width: 100%; border-radius: 5%; margin-bottom: 1%;">
                    The huge population living in a city can't always run from war. Sickness, disease, low supplies, and no food or water make conditions terrible to live in.[1] However, there is an advantage to being in an urban area; empty homes and buildings provide concealment and cover, and they can hold large camps for soldiers or civilians caught up in the violence. You can also build anything from materials found or recycled from homes, which can protect a city or build more camps when the area is under siege. Disadvantages include:
                     <ul>
                      <li>Panic is obviously an issue, and while ridiculous and unorganized, it happens. (Applies to early hours.).</li>
                      <li>Large cities will likely be a target for airstrikes or artillery shelling, increasing the risk to residents</li>
                      <li>Cities will likely become crowded(especially once refugees start to arrive), and access to clean water, medical treatment, and proper corpse disposal may be limited, which can cause infectious diseases to spread.</li>
                      <li>Civil unrest and a potential police shortage can result in widespread looting.</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #bbf7d8;">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;">3. Know what to expect in a rural environment
                    </h6>
                  </div>
                  <div class="card-body">
                    <img src="img/tips/step-3.jpg" style="height: auto; width: 100%; border-radius: 5%; margin-bottom: 1%;">
                    This is where food is made, raw materials are produced, military bases are built, and the greatest weapon mankind has made, nukes, are in the rural zone, one of the most safest places you can be (for a while). The low density makes it ideal for survival, but the skill and knowledge that people know in the rural zone makes it difficult for urban survivors, unless, you can match that. The advantages include: 
                     <ul>
                      <li>Food is produced here, thus allowing a source of food. (Applies depending on conditions).</li>
                      <li>Airstrikes and shelling are less likely to hit rural areas, unless you are located near an important facility that could be targeted(eg. power plants, airfields, nuclear silos)</li>
                      <li>The raw materials are usually produced here. (Applies depending on conditions.)</li>
                      <li>Somebody is bound to know some sort of skill that aids survival. (Applies depending on area present.)</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #bbf7d8;">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;">4. Be aware of the disadvantages of the rural situation too
                    </h6>
                  </div>
                  <div class="card-body">
                    <img src="img/tips/step-4.jpg" style="height: auto; width: 100%; border-radius: 5%; margin-bottom: 1%;">
                    These include: 
                     <ul>
                      <li>Depending on the area, you may have little to no access to clean water</li>
                      <li>You will have less access to humanitarian aid resources, when they are set up</li>
                      <li>Although the risk of bombing is lower, there is still the danger of running into landmines or unexploded ordnance(UXO)</li>
                      <li>Looters that may or may not have experience on the rural zone. (Applies depending on conditions.)</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #bbf7d8;">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;">5. Consider the population
                    </h6>
                  </div>
                  <div class="card-body">
                    <img src="img/tips/step-5.jpg" style="height: auto; width: 100%; border-radius: 5%; margin-bottom: 1%;">
                    The population, or pop. for short, is an important factor. Start studying the people who live in your area. Are they psychopaths? Kleptomaniacs? Survivalists? Extremists? Whatever they may be, learning the nature of the people is important. You never know if they have some sort of skill you don't know or maybe they have a history of something that can be potentially lethal.
                  </div>
                </div>
              </div>

              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #bbf7d8;">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;">6. Plan things out
                    </h6>
                  </div>
                  <div class="card-body">
                    <img src="img/tips/step-6.jpg" style="height: auto; width: 100%; border-radius: 5%; margin-bottom: 1%;">
                    History shows that a well thought out plan often has success. Through demonstrations, it is proven true. It holds true to this day. So start planning for the incoming war(s). Take in everything into consideration. The following are examples:
                     <ul>
                      <li>Manpower. The resource is abundant in the pre-war phase, so you need to take this while you still can. Find as many people you trust as you can.</li>
                      <li>Supplies. So little can be found in the war zone. You need as many supplies as possible to survive, but don't focus on just gathering supplies; focus on finding a reliable source of supply production too.</li>
                      <li>Skill. Somebody needs to have a skill on something, otherwise the group can't survive enough.</li>
                    </ul>                    
                  </div>
                </div>
              </div>

              <div class="card shadow row mb-2">
                <div class="card shadow">
                  <div class="card-header" style="background-color: #bbf7d8;">
                    <h6 class="m-0 font-weight-bold" style="color: #1b5b3a;">7. Stock up on supplies
                    </h6>
                  </div>
                  <div class="card-body">
                    <img src="img/tips/step-7.jpg" style="height: auto; width: 100%; border-radius: 5%; margin-bottom: 1%;">
                    If a war breaks out, supplies will quickly become scarce and rationing may be implemented. Therefore, it is essential to gather resources before a conflict begins. Important supplies to have include: 
                     <ul>
                      <li>Clean water. You should plan to store at least one gallon per person per day. Water purification tablets should also be stored.</li>
                      <li>Nonperishable food, such as canned foods, dry rice & pasta, dried fruits, nuts, granola bars, cereal, jerky, peanut butter, and MREs. Make sure to protect your food against spoilage by keeping it in a cool, dry, pest-free area.</li>
                      <li>Cooking supplies. Cookware, plates, bowls, cups, and some form of heat source for cooking should be included.</li>
                      <li>Basic medical supplies, including bandages, gauze, medical tape, scissors, forceps, rubbing alcohol, triple antibiotic ointment, aspirin or acetaminophen, diphenhydramine, an antidiarrheal medication, and oral rehydration salts. In addition, you may also wish to acquire potassium iodide tablets(to protect against radiation exposure in case of fallout) and an atropine/pralidoxime autoinjector(as an antidote to nerve agent exposure).</li>
                      <li>Hygiene products, such as soap, toothpaste, toothbrushes, sunscreen, bug spray, etc.</li>
                      <li>Flashlights, battery-powered radio, and extra batteries</li>
                      <li>Protective gear. This may include gloves, boots, safety glasses, hardhats, or gas masks.</li>
                      <li>Other survival supplies, such as matches, duct tape, a map and compass, emergency blankets, a pocket knife, etc.</li>
                    </ul>                    
                  </div>
                </div>
              </div>              
              <!-- End Feed Container -->
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                <div class="card-header">
                  <h6 class="m-0 font-weight-bold" style="color: green;">Suggestions</h6>
                </div>
                <div class="card-body">
<?php while($newUsersSuggestion=$getUsersSuggestion->fetch_assoc()){ ?>                  
                  <!-- Content Suggestions -->
                  <?php include('suggestions.php'); ?>                                    
                  <!-- End Content Suggestions -->
<?php } ?>
                 <center style="font-size: 11px;">--- NOTHING FOLLOWS ---</center>                   
                </div>                
                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php
  include('footer.php');
?>