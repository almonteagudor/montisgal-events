using montisgal_events.domain.Shared.Exceptions;

namespace montisgal_events.domain.User.ValueObjects;

public class UserName
{
    public string Value { get; }

    private const int MinLength = 3;
    private const int MaxLength = 100;

    internal UserName(string value)
    {
        Validate(value);

        Value = value;
    }

    private static void Validate(string value)
    {
        if (string.IsNullOrWhiteSpace(value)) throw new NullValueException();

        switch (value.Length)
        {
            case < MinLength:
                throw new MinLengthException(MinLength);
            case > MaxLength:
                throw new MaxLengthException(MaxLength);
        }
    }
}