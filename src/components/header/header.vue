<template>
  <header>
    <h1>Event Management System</h1>
    <nav>
      <ul>
        <li>
          <router-link to="/">Home</router-link>
        </li>
        <li>
          <router-link to="/signup">Sign Up</router-link>
        </li>
        <li>
          <router-link to="/signin">Sign In</router-link>
        </li>
        <li>
          <router-link to="/eventhome">Events</router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>

<style scoped>
  header {
    height: 56px;
    display: flex;
    flex-flow: row;
    justify-content: space-between;
    align-items: center;
    background-color: black;
    padding: 0 20px;
  }

  nav {
    height: 100%;
  }

  ul {
    list-style: none;
    margin: 0;
    padding: 0;
    height: 100%;
    display: flex;
    flex-flow: row;
    align-items: center;
  }

  li {
    margin: 0 16px;
  }

  li a {
    text-decoration: none;
    color: white;
  }

  li a:hover,
  li a:active,
  li a.router-link-active {
    color: gold;
  }

header h1 {
  color: white;
  margin: 0px;
  font-size: 95%;
  float: left;
  font-weight: bold;
}

header img {
  margin: 10px;
  max-width: 100%;
  max-height: 75%;

}
</style>