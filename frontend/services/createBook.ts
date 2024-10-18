export default async function createBook(
  title: string,
  authorId: string,
  publisher: string
): Promise<void> {
  const body = JSON.stringify({ title, publisher, authorId });
  const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/books`, {
    method: "POST",
    body,
    headers: { "Content-Type": "application/json" },
    mode: "cors",
  });
  if (!response.ok) {
    throw new Error("Failed to create book", { cause: response.statusText });
  }
  return response.json();
}
