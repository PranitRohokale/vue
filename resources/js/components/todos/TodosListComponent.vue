<template>
    <div>
        <h1>Todos List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Complexity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="todo in todos" :key="todo.id">
                    <td>{{ todo.title }}</td>
                    <td>{{ todo.description }}</td>
                    <td>{{ todo.complexity }}</td>
                    <td>
                        <router-link
                            :to="{
                                name: 'todos.show',
                                params: { id: todo.id },
                            }"
                            class="btn btn-primary"
                            >View</router-link
                        >
                        <router-link
                            :to="{
                                name: 'todos.edit',
                                params: { id: todo.id },
                            }"
                            class="btn btn-secondary"
                            >Edit</router-link
                        >
                        <button
                            @click="deleteTodo(todo.id)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            URL: {
                getTodos: "/api/todos/",
            },
            todos: [
                {
                    id: 1,
                    title: "Todo 1",
                    description: "This is the description of Todo 1",
                    complexity: "medium",
                },
                {
                    id: 2,
                    title: "Todo 2",
                    description: "This is the description of Todo 2",
                    complexity: "low",
                },
                {
                    id: 3,
                    title: "Todo 3",
                    description: "This is the description of Todo 3",
                    complexity: "high",
                },
            ],
        };
    },
    methods: {
        deleteTodo(id) {
            if (confirm("Are you sure you want to delete this todo?")) {
                // Perform the delete operation here
                // You can emit an event to the parent component or call an API to delete the todo
                this.todos = this.todos.filter((todo) => todo.id !== id);
            }
        },
        fetchTodo() {
            axios
                .get(this.URL.getTodos)
                .then((res) => {
                    this.todos = res?.data?.data;
                })
                .catch((error) => {
                    console.log("Error at fetching ", error);
                });
        },
    },
    mounted() {
        this.fetchTodo();
    },
};
</script>
