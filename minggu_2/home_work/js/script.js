"use strict";

const CONFIG = {
  DATA_URL: "data/profile.json"
};

const state = {
  profileData: null,
  skills: [],
  isLoading: false,
  isSubmitting: false
};

const DOM = {
  loadingState: document.getElementById("loadingState"),
  errorState: document.getElementById("errorState"),
  emptyState: document.getElementById("emptyState"),
  contentState: document.getElementById("contentState"),
  errorMessage: document.getElementById("errorMessage"),
  retryBtn: document.getElementById("retryBtn"),
  
  profileName: document.getElementById("profileName"),
  profileRole: document.getElementById("profileRole"),
  profileBio: document.getElementById("profileBio"),
  profileLocation: document.getElementById("profileLocation"),
  
  toggleDetailBtn: document.getElementById("toggleDetailBtn"),
  profileDetails: document.getElementById("profileDetails"),
  
  themeToggleBtn: document.getElementById("themeToggleBtn"),
  
  addSkillForm: document.getElementById("addSkillForm"),
  skillInput: document.getElementById("skillInput"),
  formFeedback: document.getElementById("formFeedback"),
  skillsList: document.getElementById("skillsList"),
  emptySkillsMessage: document.getElementById("emptySkillsMessage")
};

function setUIState(activeState) {
  DOM.loadingState.classList.add("hidden");
  DOM.errorState.classList.add("hidden");
  DOM.emptyState.classList.add("hidden");
  DOM.contentState.classList.add("hidden");

  switch (activeState) {
    case "LOADING":
      DOM.loadingState.classList.remove("hidden");
      break;
    case "ERROR":
      DOM.errorState.classList.remove("hidden");
      break;
    case "EMPTY":
      DOM.emptyState.classList.remove("hidden");
      break;
    case "CONTENT":
      DOM.contentState.classList.remove("hidden");
      break;
  }
}

async function fetchProfileData(url = CONFIG.DATA_URL) {
  state.isLoading = true;
  setUIState("LOADING");

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const text = await response.text();
    if (!text || text.trim() === "") {
      setUIState("EMPTY");
      return;
    }

    const data = JSON.parse(text);

    if (!data || Object.keys(data).length === 0) {
      setUIState("EMPTY");
      return;
    }

    state.profileData = data;
    state.skills = Array.isArray(data.skills) ? [...data.skills] : [];
    
    renderProfile();
    renderSkills();
    setUIState("CONTENT");

  } catch (error) {
    DOM.errorMessage.textContent = "Gagal memuat data profil. Periksa kembali path JSON.";
    setUIState("ERROR");
  } finally {
    state.isLoading = false;
  }
}

function renderProfile() {
  const { name, role, bio, location } = state.profileData;
  DOM.profileName.textContent = name || "Tanpa Nama";
  DOM.profileRole.textContent = role || "";
  DOM.profileBio.textContent = bio || "-";
  DOM.profileLocation.textContent = location || "-";
}

function renderSkills() {
  DOM.skillsList.replaceChildren();

  if (state.skills.length === 0) {
    DOM.emptySkillsMessage.classList.remove("hidden");
    return;
  }

  DOM.emptySkillsMessage.classList.add("hidden");

  state.skills.forEach((skill, index) => {
    const li = document.createElement("li");
    li.className = "skill-item";

    const span = document.createElement("span");
    span.textContent = skill;

    const deleteBtn = document.createElement("button");
    deleteBtn.className = "btn btn-danger";
    deleteBtn.textContent = "Hapus";
    deleteBtn.type = "button";
    deleteBtn.addEventListener("click", () => handleDeleteSkill(index));

    li.appendChild(span);
    li.appendChild(deleteBtn);
    DOM.skillsList.appendChild(li);
  });
}

function handleAddSkill(event) {
  event.preventDefault();

  if (state.isSubmitting) return;
  state.isSubmitting = true;

  const value = DOM.skillInput.value.trim();

  if (value === "") {
    showFeedback("Nama keterampilan tidak boleh kosong.");
    state.isSubmitting = false;
    return;
  }

  hideFeedback();
  state.skills.push(value);
  DOM.skillInput.value = "";
  renderSkills();

  state.isSubmitting = false;
}

function handleDeleteSkill(index) {
  state.skills.splice(index, 1);
  renderSkills();
}

function showFeedback(message) {
  DOM.formFeedback.textContent = message;
  DOM.formFeedback.classList.remove("hidden");
}

function hideFeedback() {
  DOM.formFeedback.textContent = "";
  DOM.formFeedback.classList.add("hidden");
}

function handleToggleDetail() {
  const isHidden = DOM.profileDetails.classList.toggle("hidden");
  DOM.toggleDetailBtn.setAttribute("aria-expanded", (!isHidden).toString());
  DOM.toggleDetailBtn.textContent = isHidden ? "Tampilkan Detail" : "Sembunyikan Detail";
}

function handleToggleTheme() {
  document.body.classList.toggle("dark-theme");
}

function initEvents() {
  DOM.toggleDetailBtn.addEventListener("click", handleToggleDetail);
  DOM.themeToggleBtn.addEventListener("click", handleToggleTheme);
  DOM.addSkillForm.addEventListener("submit", handleAddSkill);
  DOM.retryBtn.addEventListener("click", () => fetchProfileData());
}

document.addEventListener("DOMContentLoaded", () => {
  initEvents();
  fetchProfileData();
});