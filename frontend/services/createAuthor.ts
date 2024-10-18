export default async function createAuthor(
  firstName: string,
  lastName: string
): Promise<Author> {
  const body = JSON.stringify({ firstName, lastName });
  const response = await fetch(
    `${process.env.NEXT_PUBLIC_API_URL}/api/authors`,
    {
      method: "POST",
      body,
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      mode: "cors",
    }
  );
  if (!response.ok) {
    throw new Error("Failed create author", { cause: response.statusText });
  }
  return response.json();
}
