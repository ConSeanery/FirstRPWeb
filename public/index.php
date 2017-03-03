<?php

require($_SERVER[ 'DOCUMENT_ROOT' ] . '/../includes/application_includes.php');

// Include the HTML layout class
require_once(FS_TEMPLATES . 'Layout.php');
require_once(FS_TEMPLATES . 'News.php');

// Connect to the database
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get the stories for column 1 from the database
$sql = 'select * from posts';
$posts = $db->query($sql);
// Run a simple query that will be rendered in column 2 below
$sql = 'select id, name, description from pages';
$res = $db->query($sql);

layout::pageTop('Csc206 Project');
layout::blogPost('Csc206 Project');
?>

<?php
 // Loop through the posts and display them
         while ($post = $posts->fetch()) {
         // Call the method to create the layout for a post
          News::story($post);
     }
?>
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Information</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Projects</a>
                                </li>
                                <li><a href="#">News</a>
                                </li>
                                <li><a href="#">Calender</a>
                                </li>
                                <li><a href="#">Staff</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Did You Know?</h4>
                    <p>Game design was invented in 1958, when the first game called Tennis for Two was completely ignored because it wasn't created by a neck-beard. about 15 years later, Pong came out and didn't have a scoring system.</p>
                </div>

            </div>

        </div>

        <!-- /.row -->

        <hr>

<?php
Layout::pageBottom();
