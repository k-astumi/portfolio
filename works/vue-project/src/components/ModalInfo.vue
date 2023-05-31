<template>
  <Teleport to="body">
    <div class="modal">
      <div class="modal-overlay" @click="close"></div>
      <div class="modal-content">
        <div class="modal-close" @click="close">
          <div class="modal-close__icon"></div>
        </div>
        <div class="modal-text">
          <slot></slot>
        </div>
      </div>
    </div>
  </Teleport>
</template>
<script setup lang="ts">
const emit = defineEmits<{
  (event: "close"): void;
}>();

function close() {
  emit("close");
}
</script>
<style lang="scss" scoped>
.modal-overlay {
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 2;
}
.modal-content {
  background-color: #fff;
  padding: 40px;
  width: 90vw;
  max-height: 80vh;
  border-radius: 8px;
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  z-index: 3;
  .modal-close {
    width: 16px;
    height: 16px;
    position: fixed;
    right: 16px;
    top: 16px;
    cursor: pointer;
    &__icon {
      width: 100%;
      height: 100%;
      position: relative;
      transform: rotate(-45deg);
      &::before {
        display: block;
        content: "";
        width: 2px;
        height: 16px;
        background-color: #999;
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
        background-color: #999;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
      }
    }
  }
  .modal-text {
    font-family: "Noto Sans JP", sans-serif;
    max-height: 60vh;
    overflow: auto;
  }
}
@media (min-width: 800px) {
  .modal-content {
    width: 600px;
  }
}
</style>
