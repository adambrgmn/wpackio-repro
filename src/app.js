const delay = (ms = 0) => new Promise(resolve => setTimeout(resolve, ms));

(async () => {
  await delay(1000);
  console.log('---app---');
})();
