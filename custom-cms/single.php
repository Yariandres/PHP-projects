<?php  include("includes/header.php"); ?> 
    </div>
  </div>
</div>

<main role="main" class="container">
<div class="row">
  <div class="col-md-8 blog-main">
  <hr>
    <div class="blog-post">
      <h2 class="blog-post-title">Sample blog post</h2>
      <p class="blog-post-meta">January 1, 2014 by <a href="#">Natalia</a></p>

      <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
      <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
      <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      <h2>Heading</h2>
      <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
      <h3>Sub-heading</h3>
      <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>     
      <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
      <ol>
        <li>Vestibulum id ligula porta felis euismod semper.</li>
        <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
        <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
      </ol>
    </div><!-- /.blog-post -->
    <blockquote>2 Comments</blockquote>

    <div class="comment-area">
      <form>
      <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Website</label>
          <input type="text" name="website" class="form-control" id="exampleInputEmail1" placeholder="Website(help)">
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Comment</label>
          <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" name="post_comment" class="btn btn-primary">Post Comment</button>
      </form>
      <hr>

      <div class="comment mt-5">
        <div class="comment-head">
        <img width="50" height="50" class="rounded" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse4.mm.bing.net%2Fth%3Fid%3DOIP.ug1hsAagPO-if-D9l5yNBgHaHa%26pid%3DApi&f=1" alt="Image of monica">
          
          <a href="#">Monica S</a>
          

            <h5 class="mt-4">Coment by Monica</h5>

            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
            <p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        
        </div>
      </div> 

      <div class="comment mt-5">
        <div class="comment-head">
        <img width="50" height="50" class="rounded" src="https://media.licdn.com/dms/image/C4E03AQEie7UmApBWuw/profile-displayphoto-shrink_200_200/0?e=1580342400&v=beta&t=EMGY8bMdo2YrCfhl91CVENnqFlxfXv8QbAQ08RG-TGI" alt="Image of monica">
          <a href="#">Natalia S</a>
          <button class="btn btn-info btn-xs ml-4">Admin</button>
          
        
          

            <h5 class="mt-4">Coment by Natalia</h5>

            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
        </div>
      </div>

    </div>

  </div><!-- /.blog-main -->

<?php include("includes/sidebar.php"); ?>

<?php include("includes/footer.php"); ?>