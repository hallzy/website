<!DOCTYPE html>
<html>
  <title>Projects - Steven Hall</title>

  <?php require("header.html"); ?>

    <div class="jumbotron">
      <div class="container">
        <h1>Steven Hall</h1>
        <h1>Projects</h1>
        <p></p>
      </div>
    </div>
    <div class="extraText">
        <div class="container">
        <p><br><br>&nbsp;&nbsp;&nbsp;&nbsp;All of the projects on this page are
        in my <a href="https://github.com/hallzy" target="_blank">GitHub
          Repository</a>. </p>

          <h2>Summary of the Projects on this Page</h2>
          <ol>
              <li>Electromagnetically Tethered Robot - <a
                  href="https://github.com/hallzy/autonomous-robot"
                  target="_blank">C Code</a></li>
              <li>Dining Philosophers Problem (Multithreading) - <a
                  href="https://github.com/hallzy/Dining-Philosopher"
                  target="_blank">C Code</a></li>
              <li>Dotfiles - <a
                  href="https://github.com/hallzy/dotfiles"
                  target="_blank">Repo</a></li>
          </ol>
          <h2>1. Electromagnetically Tethered Robot</h2>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;Programmed in C, the Autonomous Robot is
          designed to follow an electromagnetic signal produced by one solenoid
          on the remote, and received by two solenoids that are on the robot
          itself. We used the voltage received by the robot to determine how
          far, or close, it is away from the controller. The code is in my
          repository. <a href="https://github.com/hallzy/autonomous-robot"
            target="_blank">Here</a>
          is a direct link to this project. This was a project for our EECE 281
          (Electrical and Computer Engineering Design Studio) class at UBC. It
          was completed in a group of six consisting of three Electrical
          Engineering Students and three Computer Engineering Students
          (including myself).
          </p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;This robot works by using three solenoids
          as a means to communicate between the robot and the controller. Two of
          them are on the robot itself, and one is on the remote control. The
          remote sends current through the solenoid which produces a magnetic
          field that the two solenoids on the robot receive, which produces a
          current on the robot. This current goes through some circuitry and to
          the processor which is used to figure out what the robot needs to do.
          By default, the robot follows the remote, which is why we need two
          solenoids on the robot. A stronger signal on the left solenoid means
          that the robot should turn left so that the right solenoid and left
          solenoid receive a similar signal strength. In addition, there are
          several buttons on the remote that we can use in order to make the
          robot do more interesting manoeuvres. Each button sends a series of
          binary bits using the magnetic field.
          </p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;Below is a video showing how the robot
          works, along with some of its capabilities. By using the buttons we
          can get the robot to turn 180 degrees and continue to follow the
          remote (except now the robot follows it while driving backwards).
          Another button makes the robot parallel park in a space that is 1.5
          times its length. Two of the other buttons make the robot get closer
          or further from the remote. We have one last button which does our
          bonus manoeuvre. Our professor's name was "Jesus" so we decided we
          would attach a marker to the back of the robot and have it draw out a
          cursive "J" for him.
          </p>
          <center><iframe width="560" height="315"
              src="http://www.youtube.com/embed/_E9AtorYnVs?rel=0"
              frameborder="0" allowfullscreen></iframe>
          </center>

          <h2>2. Dining Philosophers Problem (Multithreading)</h2>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;The solution to this problem was written in
          C. The code is on my repository; <a
          href="https://github.com/hallzy/Dining-Philosopher"
          target="_blank">here</a>
          is a link directly to this project. This was an assignment for our
          CPSC 261 (Basics of Computer Systems) class.
          </p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;So what is the dining philosophers problem?
          Good question!
          <a href="https://en.wikipedia.org/wiki/Dining_philosophers_problem"
            target="_blank">The Dining Philosophers Problem</a>
          is an exercise that uses multithreading. That is, you have multiple
          parts of your program being executed at the same time. In this
          particular problem, we have five philosophers sitting at a table with
          five plates and five forks. In programming terms, this means that we
          have five threads (one for each philosopher) and five mutex locks (one
          for each fork). A mutex lock is just a way to make sure that more than
          one thread is not using the same resource. In this case, we lock the
          fork when a philosopher picks it up so that no other philosopher can
          use that fork. The problem is each philosopher needs two forks to eat
          (I know, who eats with two forks?). Regardless, the problem is that a
          maximum of two people can eat at any given time. So if you get your
          philosophers to start eating at the same time, they all pick up a
          fork, but no one can get a second fork because they are all being
          used, which causes a deadlock. This means that the program can not
          proceed because nothing can happen until the philosophers put down
          their forks. So as part of our assignment, we have three different
          implementations.
          </p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;The first implementation is the file
          "phil.c" on my repository. This program illustrates the deadlock
          problem, as it always ends in deadlock. All the philosophers pick up
          their left forks, and can't do anything.
          </p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;The second implementation is in the file
          "phil-ordered.c" on my repository. In this file, the philosophers
          always pick up the forks in the same order (in other words, they
          always pick up their left fork, and then their right fork in that
          order). This program attempts to grab the forks, and if they can't,
          they take a nap and try again later.
          </p>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;The last implementation is in the file
          "phil-random.c" on my repository. In this program, the philosophers
          randomly pick up their left or right fork first, and then whichever
          one they did not pick up for their second fork. This time, if they
          fail to pick up their fork, they drop all of their forks and take a
          nap. This allows the opportunity for other philosophers to grab their
          forks to finish their meal.
          </p>
          <h2>3. Dotfiles</h2>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;This repo contains all of my scripts and
          configuration files from my home folder. It includes a vimrc and vim
          plugins. For more information please visit the repository
          <a href="https://github.com/hallzy/dotfiles" target="_blank">here</a>.
          </p>

        </div>
    </div>

  <?php require("footer.html"); ?>

</html>
