<template>
  <div class="todo">
    <div class="todo__inner">
      <div class="input-box">
        <input
          type="text"
          class="input-box__input"
          placeholder="input TO DO"
          v-model="todoText"
        />
        <div class="input-box__add" @click="addTodo()">
          <div class="add-inner"></div>
        </div>
      </div>
      <p class="todo-title">TO DO</p>
      <ul class="list">
        <li class="list__item" v-for="(item, i) in list" :key="i">
          {{ item }}
          <div class="list__remove" @click="removeTodo(i)">
            <div class="remove-inner"></div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>
<script setup lang="ts">
import { ref } from "vue";
const list = ref(["check mail", "call mom", "buy milk"]);
const todoText = ref("");
const addTodo = () => {
  if (todoText.value !== "") {
    list.value.push(todoText.value);
    todoText.value = "";
  }
};
const removeTodo = (index: any) => {
  list.value.splice(index, 1);
};
</script>
<style lang="scss" scoped>
.todo {
  background-color: #1a2733;
  height: 100%;
  &__inner {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 16px;
  }
  .input-box {
    &__input {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 16px 24px;
      width: 100%;
      border-radius: 50px;
      color: #fff;
      position: relative;
    }
    &__add {
      background-color: #689ccc;
      width: 32px;
      height: 32px;
      border-radius: 50px;
      position: absolute;
      right: 0;
      top: 50%;
      transform: translate(-50%, -50%);
      cursor: pointer;
      .add-inner {
        width: 100%;
        height: 100%;
        position: relative;
        &::before {
          display: block;
          content: "";
          width: 2px;
          height: 16px;
          background-color: #fff;
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
        }
        &::after {
          display: block;
          content: "";
          width: 16px;
          height: 2px;
          background-color: #fff;
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
        }
      }
    }
  }
  .todo-title {
    margin-top: 40px;
    font-size: 20px;
    font-weight: bold;
    color: #4e7599;
  }
  .list {
    margin-top: 16px;
    &__item {
      background-color: #30485e;
      padding: 16px;
      border-radius: 8px;
      color: #fff;
      position: relative;
      & + .list__item {
        margin-top: 16px;
      }
    }
    &__remove {
      width: 32px;
      height: 32px;
      cursor: pointer;
      position: absolute;
      right: -8px;
      top: 50%;
      transform: translate(-50%, -50%);
      .remove-inner {
        width: 100%;
        height: 100%;
        position: relative;
        &::before {
          display: block;
          content: "";
          width: 1px;
          height: 14px;
          background-color: #fff;
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%) rotate(-45deg);
        }
        &::after {
          display: block;
          content: "";
          width: 14px;
          height: 1px;
          background-color: #fff;
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%) rotate(135deg);
        }
      }
    }
  }
}
</style>
