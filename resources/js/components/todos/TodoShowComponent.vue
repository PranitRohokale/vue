<template>
    <div>
      <div class="card">
        <div class="card-header">Todo Details</div>
        <div class="card-body">
          <h5 class="card-title">{{ todo.title }}</h5>
          <p class="card-text">{{ todo.description }}</p>
          <p class="card-text"><strong>Complexity:</strong> {{ todo.complexity }}</p>
          <p class="card-text"><strong>Status:</strong> {{ todo.isComplete ? 'Complete' : 'Incomplete' }}</p>
        </div>
      </div>
      <div class="mt-3">
        <router-link :to="{ name: 'todos.edit', params: { id: todo.id } }" class="btn btn-primary">Edit</router-link>
        <button @click="deleteTodo" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: ['todo'],
  
    methods: {
      deleteTodo() {
        if (confirm('Are you sure you want to delete this todo?')) {
          // Perform the delete operation here
          // You can emit an event to the parent component or call an API to delete the todo
        }
      },
    },
  };
  </script>
  