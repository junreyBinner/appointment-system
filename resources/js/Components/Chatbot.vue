<script setup>
import { ref, nextTick } from "vue";
import axios from "axios";

const isOpen = ref(false);
const message = ref("");
const loading = ref(false);
const isTyping = ref(false); // 🔒 typing lock
const recognizing = ref(false);
let recognition = null;

const voiceEnabled = ref(true);
const actions = ref([]);
const quickReply = (text) => {
    message.value = text;
    actions.value = [];
    sendMessage();
};

const messages = ref([
    { from: "bot", text: "Hello 👋 Paano kita matutulungan?" },
]);

const toggleChat = () => {
    isOpen.value = !isOpen.value;
};

const sendMessage = async () => {
    if (!message.value.trim()) return;
    if (isTyping.value) return; // 🚫 block habang nagta-type

    // push user message
    messages.value.push({ from: "user", text: message.value });
    const userMessage = message.value;
    message.value = "";

    loading.value = true;
    await nextTick();
    scrollToBottom();

    try {
        const res = await axios.post("/chat/send", {
            message: userMessage,
        });

        actions.value = res.data.actions || [];

        const reply = String(res.data.reply || "");

        // fake thinking delay
        await sleep(500);

        loading.value = false;
        await typeBotMessage(reply);
    } catch (e) {
        loading.value = false;
        await typeBotMessage("Oops 😅 may error. Try ulit.");
    }
};

const typeBotMessage = async (fullText) => {
    if (!fullText) return;

    isTyping.value = true;

    const botMsg = { from: "bot", text: "" };
    messages.value.push(botMsg);

    for (let i = 0; i < fullText.length; i++) {
        botMsg.text += fullText[i];
        await sleep(25); // typing speed
        await nextTick();
        scrollToBottom();
    }

    isTyping.value = false;
    speak(fullText);
};

const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

const scrollToBottom = () => {
    const el = document.getElementById("chat-body");
    if (el) el.scrollTop = el.scrollHeight;
};

const startVoice = () => {
    if (
        !("webkitSpeechRecognition" in window || "SpeechRecognition" in window)
    ) {
        alert("Sorry 😅 hindi supported ang voice input sa browser mo.");
        return;
    }

    const SpeechRecognition =
        window.SpeechRecognition || window.webkitSpeechRecognition;

    recognition = new SpeechRecognition();
    recognition.lang = "fil-PH";
    recognition.interimResults = false;
    recognition.continuous = false;

    recognition.onstart = () => {
        recognizing.value = true;
    };

    recognition.onend = () => {
        recognizing.value = false;
    };

    recognition.onerror = () => {
        recognizing.value = false;
    };

    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript;
        message.value = transcript;
        sendMessage();
    };

    recognition.start();
};

const speak = (text) => {
  if (!voiceEnabled.value) return
  if (!("speechSynthesis" in window)) return

  const utterance = new SpeechSynthesisUtterance(text)
  utterance.rate = 0.95
  utterance.pitch = 1.1

  let voices = window.speechSynthesis.getVoices()

  const preferred = voices.find(v =>
    v.lang === "fil-PH" ||
    v.lang === "en-PH" ||
    v.name.toLowerCase().includes("alona") ||
    v.name.toLowerCase().includes("filipino")
  )

  if (preferred) utterance.voice = preferred

  window.speechSynthesis.cancel()
  window.speechSynthesis.speak(utterance)
}


const setFemaleVoice = (utterance, voices) => {
    const femaleVoice = voices.find((v) =>
        /female|samantha|zira|google/.test(v.name.toLowerCase()),
    );

    if (femaleVoice) utterance.voice = femaleVoice;
};
</script>

<template>
    <!-- Floating Button -->
    <button
        @click="toggleChat"
        class="fixed bottom-6 right-6 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 z-50"
    >
        💬
    </button>

    <!-- Chat Window -->
    <div
        v-if="isOpen"
        class="fixed bottom-24 right-6 w-80 h-96 bg-white rounded-xl shadow-xl flex flex-col z-50"
    >
        <!-- Header -->
        <div
            class="bg-blue-600 text-white p-3 rounded-t-xl flex justify-between items-center"
        >
            <div class="flex items-center gap-2">
                <span class="font-semibold">Clinic Assistant 🤖</span>

                <button
                    @click="voiceEnabled = !voiceEnabled"
                    class="text-sm bg-white/20 px-2 py-1 rounded hover:bg-white/30"
                >
                    {{ voiceEnabled ? "🔊" : "🔇" }}
                </button>
            </div>

            <button @click="toggleChat">✖</button>
        </div>

        <!-- Messages -->
        <div
            id="chat-body"
            class="flex-1 p-3 overflow-y-auto space-y-3 text-sm"
        >
            <div
                v-for="(msg, index) in messages"
                :key="index"
                class="flex"
                :class="msg.from === 'user' ? 'justify-end' : 'justify-start'"
            >
                <!-- BOT AVATAR -->
                <div v-if="msg.from === 'bot'" class="mr-2">
                    <div
                        class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm"
                    >
                        🤖
                    </div>
                </div>

                <!-- MESSAGE -->
                <div
                    :class="
                        msg.from === 'user'
                            ? 'bg-blue-600 text-white'
                            : 'bg-gray-200 text-gray-800'
                    "
                    class="px-3 py-2 rounded-lg max-w-[70%]"
                >
                    {{ msg.text }}
                </div>

                <!-- USER AVATAR -->
                <div v-if="msg.from === 'user'" class="ml-2">
                    <div
                        class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white text-sm"
                    >
                        U
                    </div>
                </div>
            </div>

            <div
                v-if="actions.length"
                class="p-2 flex flex-wrap gap-2 border-t bg-gray-50"
            >
                <button
                    v-for="(act, i) in actions"
                    :key="i"
                    @click="quickReply(act)"
                    class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full hover:bg-blue-200"
                >
                    {{ act }}
                </button>
            </div>

            <!-- Typing Indicator -->
            <div
                v-if="loading"
                class="flex items-center gap-2 text-gray-400 text-xs"
            >
                🤖
                <span> Bot is typing<span class="dots"></span> </span>
            </div>
        </div>

        <!-- Input -->
        <div class="p-2 border-t flex gap-2 items-center">
            <input
                v-model="message"
                :disabled="loading || isTyping"
                @keyup.enter="sendMessage"
                type="text"
                placeholder="Type your message..."
                class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none disabled:opacity-50"
            />
            <button
                @click="sendMessage"
                :disabled="loading || isTyping"
                class="bg-blue-600 text-white px-3 rounded-lg hover:bg-blue-700 disabled:opacity-50"
            >
                Send
            </button>
            <button
                @click="startVoice"
                :disabled="recognizing || loading || isTyping"
                class="bg-gray-200 text-gray-700 px-3 rounded-lg hover:bg-gray-300 disabled:opacity-50"
            >
                🎤
            </button>
        </div>
    </div>
</template>

<style scoped>
.dots::after {
    content: "";
    animation: dots 1.5s infinite;
}

@keyframes dots {
    0% {
        content: "";
    }
    33% {
        content: ".";
    }
    66% {
        content: "..";
    }
    100% {
        content: "...";
    }
}
</style>
