<template>
  <div
    class="info-button"
    @click="
      openModal();
      showContent = true;
    "
  >
    <img src="/icon_info_gray.svg" alt="" />
    <p class="info-button__text">このページの情報</p>
  </div>
  <div class="content">
    <h1>ブランド一覧</h1>
    <div class="search-textbox">
      <input
        type="text"
        v-model="searchWord"
        @input="onInput()"
        placeholder="ブランド名で検索"
      />
    </div>
    <div class="brand-search">
      <div class="brand-search__button" @click="search($event, 'A')">A</div>
      <div class="brand-search__button" @click="search($event, 'B')">B</div>
      <div class="brand-search__button" @click="search($event, 'C')">C</div>
      <div class="brand-search__button" @click="search($event, 'D')">D</div>
      <div class="brand-search__button" @click="search($event, 'E')">E</div>
      <div class="brand-search__button" @click="search($event, 'F')">F</div>
      <div class="brand-search__button" @click="search($event, 'G')">G</div>
      <div class="brand-search__button" @click="search($event, 'H')">H</div>
      <div class="brand-search__button" @click="search($event, 'I')">I</div>
      <div class="brand-search__button" @click="search($event, 'J')">J</div>
      <div class="brand-search__button" @click="search($event, 'K')">K</div>
      <div class="brand-search__button" @click="search($event, 'L')">L</div>
      <div class="brand-search__button" @click="search($event, 'M')">M</div>
      <div class="brand-search__button" @click="search($event, 'N')">N</div>
      <div class="brand-search__button" @click="search($event, 'O')">O</div>
      <div class="brand-search__button" @click="search($event, 'P')">P</div>
      <div class="brand-search__button" @click="search($event, 'Q')">Q</div>
      <div class="brand-search__button" @click="search($event, 'R')">R</div>
      <div class="brand-search__button" @click="search($event, 'S')">S</div>
      <div class="brand-search__button" @click="search($event, 'T')">T</div>
      <div class="brand-search__button" @click="search($event, 'U')">U</div>
      <div class="brand-search__button" @click="search($event, 'V')">V</div>
      <div class="brand-search__button" @click="search($event, 'W')">W</div>
      <div class="brand-search__button" @click="search($event, 'X')">X</div>
      <div class="brand-search__button" @click="search($event, 'Y')">Y</div>
      <div class="brand-search__button" @click="search($event, 'Z')">Z</div>
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
  <ModalInfoComponent
    v-if="showContent"
    @close="
      closeModal();
      showContent = false;
    "
    >アルファベットのボタンとテキスト入力両方でデータの絞り込みができるページです。<br />
    「A」ボタンを押すと、Aから始まる名前のブランドが絞り込まれて下に表示されます。上のフォームに入力した際も同様にブランドが絞り込まれます。<br />
    ブランド情報は別ファイルとしてjsonをimportしています。<br />
    v-modelと@inputを使うことでリアルタイム検索を簡単に実装することができました。
  </ModalInfoComponent>
</template>
<script setup lang="ts">
import { ref } from "vue";
import brandList from "@/data/brandList.json";
import ModalInfoComponent from "@/components/ModalInfo.vue";
const searchWord = ref();
const result: any = ref([]);

const onInput = () => {
  result.value = [];
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
//モーダル
const showContent = ref(false);
const openModal = () => {
  document.body.classList.add("is-locked");
};
const closeModal = () => {
  document.body.classList.remove("is-locked");
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
