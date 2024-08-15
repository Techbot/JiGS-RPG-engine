export default function logMessage() {
  return ({ time, message }) => {
    console.log(`${time}\t${message}`);
  }
};
