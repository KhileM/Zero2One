<template>
    <div>
      <input v-model="query" placeholder="Search movies..." />
      <button @click="searchMovies">Search</button>
      <ul>
        <li v-for="movie in movies" :key="movie.imdbID">
          {{ movie.Title }}
          <button @click="addToWatchlist(movie.imdbID)">Add</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        query: '',
        movies: [],
      };
    },
    methods: {
      searchMovies() {
        axios.get('/movies/search', { params: { query: this.query } })
          .then(res => this.movies = res.data.Search);
      },
      addToWatchlist(imdb_id) {
        axios.post('/movies/add', { imdb_id })
          .then(() => alert('Added!'));
      },
    },
  };
  </script>
  