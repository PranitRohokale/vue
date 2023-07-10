<template>
    <div>
      <h2>Create Todo</h2>
      <form @submit.prevent="createTodo">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" v-model="title" required>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" v-model="description"></textarea>
        </div>
        <div class="form-group">
          <label for="complexity">Complexity</label>
          <select class="form-control" id="complexity" v-model="complexity">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        title: '',
        description: '',
        complexity: 'low',
      };
    },
    methods: {
      createTodo() {
        const todo = {
          title: this.title,
          description: this.description,
          complexity: this.complexity,
        };
  
        // TODO:
        axios.post('/api/todos', todo)
          .then(response => {
            console.log('Todo created successfully:', response.data);
            
            this.title = '';
            this.description = '';
            this.complexity = 'low';
          })
          .catch(error => {

            console.error('Failed to create todo:', error.response.data);
          });
      },
    },
  };
  </script>
  