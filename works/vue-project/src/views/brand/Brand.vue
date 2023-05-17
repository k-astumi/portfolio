<template>
  <div class="content">
    <h1>ブランド一覧</h1>
    <div class="search-textbox">
      <input
        type="text"
        v-model="searchWord"
        @input="
          onInput();
          isSearchStart = true;
        "
        placeholder="ブランド名で検索"
      />
    </div>
    <div class="brand-search">
      <div
        class="brand-search__button"
        @click="
          search($event, 'A');
          isSearchStart = true;
        "
      >
        A
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'B');
          isSearchStart = true;
        "
      >
        B
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'C');
          isSearchStart = true;
        "
      >
        C
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'D');
          isSearchStart = true;
        "
      >
        D
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'E');
          isSearchStart = true;
        "
      >
        E
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'F');
          isSearchStart = true;
        "
      >
        F
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'G');
          isSearchStart = true;
        "
      >
        G
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'H');
          isSearchStart = true;
        "
      >
        H
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'I');
          isSearchStart = true;
        "
      >
        I
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'J');
          isSearchStart = true;
        "
      >
        J
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'K');
          isSearchStart = true;
        "
      >
        K
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'L');
          isSearchStart = true;
        "
      >
        L
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'M');
          isSearchStart = true;
        "
      >
        M
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'N');
          isSearchStart = true;
        "
      >
        N
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'O');
          isSearchStart = true;
        "
      >
        O
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'P');
          isSearchStart = true;
        "
      >
        P
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'Q');
          isSearchStart = true;
        "
      >
        Q
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'R');
          isSearchStart = true;
        "
      >
        R
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'S');
          isSearchStart = true;
        "
      >
        S
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'T');
          isSearchStart = true;
        "
      >
        T
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'U');
          isSearchStart = true;
        "
      >
        U
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'V');
          isSearchStart = true;
        "
      >
        V
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'W');
          isSearchStart = true;
        "
      >
        W
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'X');
          isSearchStart = true;
        "
      >
        X
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'Y');
          isSearchStart = true;
        "
      >
        Y
      </div>
      <div
        class="brand-search__button"
        @click="
          search($event, 'Z');
          isSearchStart = true;
        "
      >
        Z
      </div>
    </div>
    <div class="brand-result">
      <div class="result" v-for="brandText in result" :key="brandText">
        <p class="result__name">
          {{ brandText.brand_name }}
          <span class="result__kana">
            {{ brandText.brand_name_kana }}
          </span>
        </p>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { ref, onMounted } from "vue";
import brandList from "@/data/brandList.json";
const isSearchStart = ref(false);
const searchWord = ref();
const result: any = ref([]);
const onInput = () => {
  result.value.length = [];
  for (let data of brandList) {
    if (data.brand_name.match(searchWord.value)) {
      result.value.push(data);
    } else if (data.brand_name_kana.match(searchWord.value)) {
      result.value.push(data);
    } else if (kanaToHira(data.brand_name_kana).match(searchWord.value)) {
      result.value.push(data);
    }
  }
  function kanaToHira(str: any) {
    return str.replace(/[\u30a1-\u30f6]/g, function (match: any) {
      var chr = match.charCodeAt(0) - 0x60;
      return String.fromCharCode(chr);
    });
  }
};

const search = (event: any, alphabet: any) => {
  document.querySelector(".active")?.classList.remove("active");
  event.target.classList.add("active");
  result.value.length = [];
  for (let data of brandList) {
    if (alphabet === data.alphabet) {
      result.value.push(data);
    }
  }
};
</script>
<style lang="scss" scoped>
.content {
  padding: 40px 16px;
}
h1 {
  font-size: 28px;
  font-weight: bold;
  text-align: center;
}
.search-textbox {
  max-width: 375px;
  margin: 40px auto 24px;
  input {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 4px 16px;
    box-sizing: border-box;
  }
}
.brand-search {
  max-width: 375px;
  margin: 0 auto;
  &__button {
    width: calc((100% - 40px) / 6);
    border: 1px solid #ccc;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    & + & {
      margin-left: 8px;
    }
    &:nth-of-type(6n + 1) {
      margin-left: 0;
    }
    &:nth-of-type(n + 7) {
      margin-top: 8px;
    }
    &::before {
      content: "";
      display: block;
      padding-top: 100%;
    }
    &.active {
      border: 1px solid #3fba84;
      color: #3fba84;
    }
  }
}
.brand-result {
  max-width: 375px;
  margin: 40px auto;

  .result {
    border-top: 1px solid #ccc;
    padding: 16px 0;
    &:last-child {
      border-bottom: 1px solid #ccc;
    }
    &__name {
      font-weight: bold;
    }
    &__kana {
      display: block;
      color: #999;
      font-size: 12px;
    }
  }
}
</style>
