<template>
    <div>
      <h2>Edit Todo</h2>
      <form @submit.prevent="updateTodo">
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
        <button type="submit" class="btn btn-primary">Update</button>
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
      updateTodo() {
        const todo = {
          title: this.title,
          description: this.description,
          complexity: this.complexity,
        };
  
        // TODO:
        axios.put(`/api/todos/${this.$route.params.id}`, todo)
          .then(response => {
            console.log('Todo updated successfully:', response.data);
                this.$router.push(`/todos/${this.$route.params.id}`);
          })
          .catch(error => {
            console.error('Failed to update todo:', error.response.data);
          });
      },
    },
    mounted() {
      axios.get(`/api/todos/${this.$route.params.id}`)
        .then(response => {
          const todo = response.data.todo;
          this.title = todo.title;
          this.description = todo.description;
          this.complexity = todo.complexity;
        })
        .catch(error => {
          console.error('Failed to fetch todo details:', error.response.data);
        });
    },
  };
  </script>
  