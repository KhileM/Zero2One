<template>
    <div>
      <ul>
        <li v-for="movie in watchlist.data" :key="movie.id">
          {{ movie.imdb_id }} | pinned: {{ movie.pinned }}
          <button @click="togglePin(movie)">Pin/Unpin</button>
          <button @click="removeMovie(movie)">Delete</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        watchlist: {},
      };
    },
    created() {
      this.getWatchlist();
    },
    methods: {
      getWatchlist() {
        axios.get('/movies/watchlist').then(res => this.watchlist = res.data);
      },
      removeMovie(movie) {
        axios.delete(`/movies/${movie.id}`).then(() => this.getWatchlist());
      },
      togglePin(movie) {
        axios.post(`/movies/${movie.id}/pin`).then(() => this.getWatchlist());
      },
    },
  };
  </script>
  