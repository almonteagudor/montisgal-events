using montisgal_events.domain.Shared.Exceptions;

namespace montisgal_events.domain.Group.ValueObjects;

public class GroupDescription
{
    public string? Value { get; }

    private const int MaxLength = 1000;

    internal GroupDescription(string? value)
    {
        Validate(value);

        Value = value;
    }

    private static void Validate(string? value)
    {
        if (value is not null && value.Length > MaxLength)
        {
            throw new MaxLengthException(MaxLength);
        }
    }
}